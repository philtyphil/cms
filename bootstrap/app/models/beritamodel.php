<?php
class Beritamodel extends CI_Model{
	private $db;
	function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default', TRUE);
	}
	
	function getberita()
	{
	   if($this->session->userdata('logged'))
       {
        $aColumns = array('a.id_berita','a.username','a.judul','a.isi_berita','a.tanggal','a.jam','a.gambar','a.dibaca','a.tag','b.nama_kategori');
	
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "id_berita";
		
		/* DB table to use */
		$sTable = "berita";
	
		/* 
		* Paging
		*/
		$sLimit = "";
		if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
		{
			$sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
				intval( $_GET['iDisplayLength'] );
		}
		
		
		/*
		* Ordering
		*/
		$sOrder = "";
		if ( isset( $_GET['iSortCol_0'] ) )
		{
			$sOrder = "ORDER BY  ";
			for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
			{
				if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
				{
					$sOrder .= "'".$aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."' ".
						($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
				}
			}
			
			$sOrder = substr_replace( $sOrder, "", -2 );
			if ( $sOrder == "ORDER BY" )
			{
				$sOrder = "ORDER BY id_berita DESC";
			}
		}
		
		
		/* 
		* Filtering
		* NOTE this does not match the built-in DataTables filtering which does it
		* word by word on any field. It's possible to do here, but concerned about efficiency
		* on very large tables, and MySQL's regex functionality is very limited
		*/
		$sWhere = "";
		if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		
		/* Individual column filtering */
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
			{
				if ( $sWhere == "" )
				{
					$sWhere = "WHERE ";
				}
				else
				{
					$sWhere .= " AND ";
				}
				$sWhere .= "'".$aColumns[$i]."' LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
			}
		}
		
		
		/*
		* SQL queries
		* Get data to display
		*/
		$sQuery = "
			SELECT ".str_replace(" , ", " ", implode(", ", $aColumns))."
			FROM $sTable a LEFT JOIN kategori b ON b.id_kategori = a.id_kategori
			$sWhere
			$sOrder
			$sLimit
			";
		$rResult = $this->db->query($sQuery)->result_array();
		$iTotal = count($rResult);
        if(isset($sWhere))
        {
			$sQueryTotal = "Select a.id_berita FROM " . $sTable . " a LEFT JOIN kategori b ON b.id_kategori = a.id_kategori " . $sWhere;
            $FetchsQuery = $this->db->query($sQueryTotal);
            $iFilteredTotal = $FetchsQuery->num_rows();
        }
        else
        {
            $iFilteredTotal = $iTotal;
        }
		
		
		/*
		* Output
		*/
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $iTotal,
			"iTotalDisplayRecords" => $iFilteredTotal,
			"aaData" => array()
		);
		
		/** Select Field To Display ON Website **/
		$color = array("green","purple","red","orange","blue","orange","gray");
		$i = 0;
		foreach($rResult as $key => $value)
		{
			if($i == count($color) - 1)
			{
				$i = 0;
			}
            $row    = array();
          	$row[]		= ' <ul class="metro_tmtimeline"><li class="'.$color[$i].'">
                            <div class="metro_tmtime" datetime="2013-04-17 12:11">
                                <span class="date">'.$value["tanggal"].'</span>
                                <span class="time">'.$value["jam"].'</span>
                            </div>
                            <div class="metro_tmicon">
                                <i class="icon-comments-alt"></i>
                            </div>
                            <div class="metro_tmlabel">
                                <h2>'.$value["judul"].'</h2>
                                <p>'.str_replace("&nbsp;"," ",rtrim(substr($value['isi_berita'],0,250)," ")) . "...".'</p>
								<br/>
								<button class="btn btn-primary" onClick="editberita('.$value['id_berita'].')"><i class="icon-pencil"></i></button>
								<button class="btn btn-danger" onClick="deleteberita('.$value['id_berita'].');"><i class="icon-trash "></i></button>
								<small class="pull-right">Posted by: '.$value["username"].'</small> 
                            </div>
                        </li></ul>';
			$output['aaData'][] = $row;
			$i++;
		}
        return $output;
	   } /** End Of Session **/
    } /** End Of Function GetUsers **/
	
	function adduser($r)
	{
		$dataInsert = array(
			"username"		=> $r["username"],
			"password"		=> $r["password"],
			"nama_lengkap"	=> $r["nama_lengkap"],
			"email"			=> $r["email"],
			"no_telp"		=> $r["no_telp"],
			"level"			=> $r["level"],
			"blokir"		=> $r["blokir"],
			"role_id"		=> $r["role_id"]
		);
		$data = $this->db->insert("users",$dataInsert);
		if($data)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function deleteuser($username)
	{
		if($this->session->userdata("logged"))
		{
			$this->db->where('username', $username);
			$data = $this->db->delete('users'); 
			return $data;
		}
	}
	
	function getroleaccess()
	{
		if($this->session->userdata("logged"))
		{
			$this->db->not_like("id_group_access","0");
			$data = $this->db->get("menu_admin_group_access");
			if($data->num_rows() > 0)
			{
				return $data->result_array();
			}
			else
			{
				return false;
			}
		}
	}
	
	function usernameCheck($str)
	{
		if($this->session->userdata("logged"))
		{
			$this->db->where("username",$str);
			$this->db->select("username");
			$this->db->from("users");
			$this->db->limit("1");
			$data = $this->db->get();
			if($data->num_rows > 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	
	function getuseredit($str)
	{
		if($this->session->userdata("logged"))
		{
			$this->db->where("username",mysql_real_escape_string($str));
			$this->db->limit("1");
			$this->db->select("*");
			$this->db->from("users");
			$data = $this->db->get();
			if($data->num_rows > 0)
			{
				return $data->result_array();
			}
			else
			{
				return false;
			}
		}
	}
	
	function saveedit($r)
	{
		if(empty($r["password"]))
		{
			$updateData = array(
				"nama_lengkap" => $r["nama_lengkap"],
				"email" => $r["email"],
				"no_telp" => $r["no_telp"],
				"level" => $r["level"],
				"blokir" => $r["blokir"],
				"role_id" => $r["role_id"]
			);
		}
		else
		{
			$updateData = array(
				"nama_lengkap" => $r["nama_lengkap"],
				"password"	=> md5($r["password"]),
				"email" => $r["email"],
				"no_telp" => $r["no_telp"],
				"level" => $r["level"],
				"blokir" => $r["blokir"],
				"role_id" => $r["role_id"]
			);
		}
		$this->db->where("username",$r['username']);
		$data = $this->db->update("users",$updateData);
		if($data)
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}
	
	function getberitaedit($id)
	{
		if($this->session->userdata("logged"))
		{
			$this->db->where("id_berita",$id);
			$this->db->limit("1");
			$this->db->select("*");
			$this->db->from("berita");
			$data = $this->db->get();
			if($data->num_rows() > 0)
			{
				return $data->result_array();
			}
			else
			{
				return false;
			}
		}
	}
	function updateBerita($o)
	{
		if(empty($o["gambar"]))
		{
			$berita = str_replace(" ","-",$o["judul"]);
			$dataUpdate = array(
				"last_edit" 	=> $o["last_edit"],
				"isi_berita" 	=> str_replace("&nbsp;"," ",$o["isi_berita"]),
				"judul" 		=> $o["judul"],
				"judul_seo"		=> preg_replace('/[^a-zA-Z0-9\']/',"_",$berita) . ".html",
				"tag"			=> $o["tag"]
			);
			$this->db->where("id_berita",intval($o['id_berita']));
		}
		else
		{
	
		/** Checking File Foto (If Photo changed, Delete Foto Before) **/
			$this->cekFileFoto($o["gambar"],$o["id_berita"]);
			$berita = str_replace(" ","-",$o["judul"]);
			$o["tag"] = str_replace("|",",",$o["tag"]);
			$dataUpdate = array(
				"last_edit" 	=> $o["last_edit"],
				"isi_berita" 	=> str_replace("&nbsp;"," ",$o["isi_berita"]),
				"judul" 		=> $o["judul"],
				"judul_seo"		=> preg_replace('/[^a-zA-Z0-9\']/',"_",$berita) . ".html",
				"gambar"		=> $o["gambar"],
				"tag"			=> $o["tag"]
			);
			$this->db->where("id_berita",intval($o['id_berita']));
		}
		
		$data = $this->db->update("berita",$dataUpdate);
		if($data)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	private function cekFileFoto($name,$id)
	{
		$this->db->where("id_berita",intval($id));
		$this->db->where("gambar",$name);
		$this->db->from("berita");
		$this->db->select("gambar");
		$data = $this->db->get();
		if($data->num_rows() > 0)
		{
			$data = $data->result_array();
			unlink("public/images/img_uploaded/imgBW_".$data[0]["gambar"]);
			unlink("public/images/img_uploaded/beritaheader_".$data[0]["gambar"]);
			unlink("public/images/img_uploaded/singlepost_".$data[0]["gambar"]);
		}
		return false;
	}
	
	function delete($id)
	{
		if($this->session->userdata("logged"))
		{
			$this->unlinkImage($id);
			$this->db->where("id_berita",$id);
			$data = $this->db->delete("berita");
			if($data)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	
	function insertberita($data)
	{
		if($this->session->userdata("logged"))
		{
			$data = $this->db->insert("berita",$data);
			if($data)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	
	function unlinkImage($id)
	{
		if($this->session->userdata("logged"))
		{
			$this->db->limit("1");
			$this->db->where("id_berita",intval($id));
			$this->db->select("gambar");
			$this->db->from("berita");
			$data = $this->db->get();
			if($data->num_rows() > 0)
			{
				$data = $data->result_array();
				if(file_exists(config_item("baseurl")."public/images/img_uploaded/banner_".$data[0]['gambar']))
				{
					unlink(config_item("baseurl")."public/images/img_uploaded/banner_".$data[0]['gambar']);
				}
				return false;
			}
			else
			{
				return false;
			}
		}
	}
	
	function getwidget($id)
	{
		if($this->session->userdata('logged'))
       {
           $aColumns = array('a.id_berita','a.username','a.judul','a.isi_berita','a.tanggal','a.jam','a.gambar','a.dibaca','a.tag','b.nama_kategori');
	
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "id_berita";
		
		/* DB table to use */
		$sTable = "berita";
	
		/* 
		* Paging
		*/
		$sLimit = "";
		if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
		{
			$sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
				intval( $_GET['iDisplayLength'] );
		}
		
		
		/*
		* Ordering
		*/
		$sOrder = "";
		if ( isset( $_GET['iSortCol_0'] ) )
		{
			$sOrder = "ORDER BY  ";
			for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
			{
				if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
				{
					$sOrder .= "'".$aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."' ".
						($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
				}
			}
			
			$sOrder = substr_replace( $sOrder, "", -2 );
			if ( $sOrder == "ORDER BY" )
			{
				$sOrder = "ORDER BY id_berita DESC";
			}
		}
		
		/* 
		* Filtering
		* NOTE this does not match the built-in DataTables filtering which does it
		* word by word on any field. It's possible to do here, but concerned about efficiency
		* on very large tables, and MySQL's regex functionality is very limited
		*/
		$sWhere = "";
		if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		
		/* Individual column filtering */
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
			{
				if ( $sWhere == "" )
				{
					$sWhere = "WHERE ";
				}
				else
				{
					$sWhere .= " AND ";
				}
				$sWhere .= "'".$aColumns[$i]."' LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
				
			}
		}
		
		if($sWhere == "")
		{
			$sWhere = " WHERE a.id_kategori = '".$id."'";
		}
		else
		{
			$sWhere .= " AND a.id_kategori = '".$id."'";
		}
		/*
		* SQL queries
		* Get data to display
		*/
		$sQuery = "
			SELECT ".str_replace(" , ", " ", implode(", ", $aColumns))."
			FROM $sTable a LEFT JOIN kategori b ON b.id_kategori = a.id_kategori
			$sWhere
			$sOrder
			$sLimit
			";
		$rResult = $this->db->query($sQuery)->result_array();
		$iTotal = count($rResult);
        if(isset($sWhere))
        {
			$sQueryTotal = "Select a.id_berita FROM " . $sTable . " a LEFT JOIN kategori b ON b.id_kategori = a.id_kategori " . $sWhere;
            $FetchsQuery = $this->db->query($sQueryTotal);
            $iFilteredTotal = $FetchsQuery->num_rows();
        }
        else
        {
            $iFilteredTotal = $iTotal;
        }
		
		
		/*
		* Output
		*/
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $iTotal,
			"iTotalDisplayRecords" => $iFilteredTotal,
			"aaData" => array()
		);
		
		/** Select Field To Display ON Website **/
		$color = array("green","purple","red","orange","blue","orange","gray");
		$i = 0;
		foreach($rResult as $key => $value)
		{
			if($i == count($color) - 1)
			{
				$i = 0;
			}
            $row    = array();
          	$row[]		= ' <ul class="metro_tmtimeline"><li class="'.$color[$i].'">
                            <div class="metro_tmtime" datetime="2013-04-17 12:11">
                                <span class="date">'.$value["tanggal"].'</span>
                                <span class="time">'.$value["jam"].'</span>
                            </div>
                            <div class="metro_tmicon">
                                <i class="icon-comments-alt"></i>
                            </div>
                            <div class="metro_tmlabel">
                                <h2>'.$value["judul"].'</h2>
                                <p>'.str_replace('&nbsp;'," ",rtrim(substr($value['isi_berita'],0,250)," ")) . "...".'</p>
								<br/>
								<button class="btn btn-primary" onClick="editberita('.$value['id_berita'].')"><i class="icon-pencil"></i></button>
								<button class="btn btn-danger" onClick="deleteberita('.$value['id_berita'].');"><i class="icon-trash "></i></button>
								<small class="pull-right">Posted by: '.$value["username"].'</small> 
                            </div>
                        </li></ul>';
			$output['aaData'][] = $row;
			$i++;
		}
        return $output;
	   } /** End Of Session **/
    } /** End Of Function getWidget **/
	
	function getwidgetname($id)
	{
		if($this->session->userdata("logged"))
		{
			$id = substr($id,3);
			$this->db->where("id_sub",mysql_real_escape_string(intval($id)));
			$this->db->limit("1");
			$this->db->select("nama_sub");
			$this->db->from("submenu_admin");
			$data = $this->db->get();
			if($data->num_rows > 0)
			{
				return $data->result_array();
			}
			else
			{
				return false;
			}
		}
	}
	
	function loadkategori()
	{
		if($this->session->userdata("logged"))
		{
			 $aColumns = array('id_kategori','nama_kategori','kategori_seo','aktif');
	
			/* Indexed column (used for fast and accurate table cardinality) */
			$sIndexColumn = "id_kategori";
			
			/* DB table to use */
			$sTable = "kategori";
		
			/* 
			* Paging
			*/
			$sLimit = "";
			if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
			{
				$sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
					intval( $_GET['iDisplayLength'] );
			}
			
			
			/*
			* Ordering
			*/
			$sOrder = "";
			if ( isset( $_GET['iSortCol_0'] ) )
			{
				$sOrder = "ORDER BY  ";
				for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
				{
					if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
					{
						$sOrder .= "'".$aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."' ".
							($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
					}
				}
				
				$sOrder = substr_replace( $sOrder, "", -2 );
				if ( $sOrder == "ORDER BY" )
				{
					$sOrder = "ORDER BY id_kategori DESC";
				}
			}
			
			
			/* 
			* Filtering
			* NOTE this does not match the built-in DataTables filtering which does it
			* word by word on any field. It's possible to do here, but concerned about efficiency
			* on very large tables, and MySQL's regex functionality is very limited
			*/
			$sWhere = "";
			if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
			{
				$sWhere = "WHERE (";
				for ( $i=0 ; $i<count($aColumns) ; $i++ )
				{
					$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
				}
				$sWhere = substr_replace( $sWhere, "", -3 );
				$sWhere .= ')';
				$sWhere .= " AND aktif = 'Y'";
			}
			else
			{
				$sWhere = " WHERE aktif='Y'";
			}
			
			/* Individual column filtering */
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
				{
					if ( $sWhere == "" )
					{
						$sWhere = "WHERE ";
					}
					else
					{
						$sWhere .= " AND ";
					}
					$sWhere .= "'".$aColumns[$i]."' LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
					$sWhere .= " AND aktif = 'Y'";
				}
			}
			
			
			
			/*
			* SQL queries
			* Get data to display
			*/
			$sQuery = "
				SELECT ".str_replace(" , ", " ", implode(", ", $aColumns))."
				FROM $sTable 
				$sWhere
				$sOrder
				$sLimit
				";
			$rResult = $this->db->query($sQuery)->result_array();
			$iTotal = count($rResult);
			if(isset($sWhere))
			{
				$sQueryTotal = "Select id_kategori FROM " . $sTable . $sWhere;
				$FetchsQuery = $this->db->query($sQueryTotal);
				$iFilteredTotal = $FetchsQuery->num_rows();
			}
			else
			{
				$iFilteredTotal = $iTotal;
			}
			
			
			/*
			* Output
			*/
			$output = array(
				"sEcho" => intval($_GET['sEcho']),
				"iTotalRecords" => $iTotal,
				"iTotalDisplayRecords" => $iFilteredTotal,
				"aaData" => array()
			);
			
			/** Select Field To Display ON Website **/
			
			foreach($rResult as $key => $value)
			{
				
				$row    = array();
				$row[]	= $value['nama_kategori'];
				$row[]	= $value['kategori_seo'];
				$row[]	= $value['aktif'] = ($value['aktif'] == "Y") ? '<button class="btn btn-success"><i class="icon-ok"></i></button>' : '<button class="btn btn-danger"><i class="icon-remove"></i></button>';
				$row[]	= '<button onclick="editkategoriberita('.intval($value['id_kategori']).')" class="btn btn-primary"><i class="icon-pencil"></i></button> <button onclick="deletekategoriberita('.intval($value["id_kategori"]).')" class="btn btn-danger">
						<i class="icon-trash "></i></button>';
				$output['aaData'][] = $row;
				$i++;
			}
			return $output;
		} /** End Of Session **/
		
	}
	
	function getEditKategori($id)
	{
		$this->db->where("id_kategori",$id);
		$this->db->where("aktif","Y");
		$this->db->select("*");
		$this->db->from("kategori");
		$data = $this->db->get();
		if($data->num_rows() > 0)
		{
			return $data->result_array();
		}
		else
		{
			return false;
		}
	}
	function ALL_KATEGORI()
	{
		$this->db->where("aktif","Y");
		$this->db->select("*");
		$this->db->from("kategori");
		$data = $this->db->get();
		if($data->num_rows() > 0)
		{
			return $data->result_array();
		}
		else
		{
			return false;
		}
	}
	
	function updateeditkategori($update,$id)
	{
		$this->db->where("id_kategori",$id);
		$data = $this->db->update("kategori",$update);
		if($data)
		{
			return $data;
		}
		else
		{
			return false;
		}
	}
	
	function deletekategori($id)
	{
		$this->db->where("id_kategori",$id);
		$data = $this->db->delete("kategori");
		if($data)
		{
			return $data;
		}
		else
		{
			return false;
		}
	}
	
}
?>
<?php
class Usermodel extends CI_Model{
	private $db;
	function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default', TRUE);
	}
	
	function getusers()
	{
	   if($this->session->userdata('logged'))
       {
           $aColumns = array('username','nama_lengkap','email','no_telp','level','blokir','role_id');
	
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "username";
		
		/* DB table to use */
		$sTable = "users";
	
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
				$sOrder = "";
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
			FROM $sTable
			$sWhere
			$sOrder
			$sLimit
			";
		$rResult = $this->db->query($sQuery)->result_array();
		$iTotal = count($rResult);
        if(isset($sWhere))
        {
            $sQueryTotal = "Select username FROM " . $sTable . " " .$sWhere;
            $FetchsQuery = $this->db->query($sQueryTotal)->result_array();
            $iFilteredTotal = count($FetchsQuery);
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
            $row[]  = "<input type='checkbox' class='checkuser' name='checkusers'>";
            $row[]  = $value['username'];
            $row[]  = $value['nama_lengkap'];
            $row[]  = $value['email'];
            $row[]  = $value['no_telp'];
            $row[]  = $value['level'];
            $row[]  = $value['blokir'];
            $row[]  = $value['role_id'];
            $row[]  = "<a href='user/edit/".$value['username']."'><i class='icon-edit'></i></a>    <a href='#' onclick='deleteuser(\"".$value['username']."\")'><i class='icon-remove'></i></a>";
			$output['aaData'][] = $row;
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
			$this->deleteImage($username);
			$this->db->where('username', mysql_real_escape_string($username));
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
			$this->db->where("username",mysql_real_escape_string($str));
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
			if(empty($r["gambar"]))
			{
				$updateData = array(
					"nama_lengkap" => $r["nama_lengkap"],
					"email" => $r["email"],
					"no_telp" => $r["no_telp"],
					"level" => $r["level"],
					"blokir" => $r["blokir"],
					"role_id" => $r["role_id"],
					"facebook" => $r["facebook"],
					"twitter" => $r["twitter"],
					"linkedin" => $r["linkedin"],
					"googleplus" => $r["googleplus"]
				);
			}
			else
			{
				$updateData = array(
					"nama_lengkap" => $r["nama_lengkap"],
					"email" => $r["email"],
					"no_telp" => $r["no_telp"],
					"level" => $r["level"],
					"blokir" => $r["blokir"],
					"role_id" => $r["role_id"],
					"gambar" => $r["gambar"],
					"facebook" => $r["facebook"],
					"twitter" => $r["twitter"],
					"linkedin" => $r["linkedin"],
					"googleplus" => $r["googleplus"]
				);
			}
		}
		else
		{
			if(empty($r["gambar"]))
			{
				$updateData = array(
					"nama_lengkap" => $r["nama_lengkap"],
					"password"	=> md5($r["password"]),
					"email" => $r["email"],
					"no_telp" => $r["no_telp"],
					"level" => $r["level"],
					"blokir" => $r["blokir"],
					"role_id" => $r["role_id"],
					"facebook" => $r["facebook"],
					"twitter" => $r["twitter"],
					"linkedin" => $r["linkedin"],
					"googleplus" => $r["googleplus"]
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
					"role_id" => $r["role_id"],
					"gambar" => $r["gambar"],
					"facebook" => $r["facebook"],
					"twitter" => $r["twitter"],
					"linkedin" => $r["linkedin"],
					"googleplus" => $r["googleplus"]
				);
				$this->deleteImage($r["username"]);
			}
		}
		
		$this->db->where("username",mysql_real_escape_string($r['username']));
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
	
	function users()
	{
		if($this->session->userdata("logged"))
		{
			$this->db->select("*");
			$this->db->from("menu_admin_group_access");
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
	
	function menuaccess($id)
	{
		if($this->session->userdata("logged"))
		{
			$this->db->where("menu_admin_group_access.id_group_access",$id);
			$this->db->select("menu_admin.nama_menu,menu_admin.id_main");
			$this->db->from("menu_admin_role_access");
			$this->db->join("menu_admin_group_access",'menu_admin_group_access.id_group_access = menu_admin_role_access.id_main','left');
			$this->db->join("menu_admin",'menu_admin.id_main = menu_admin_role_access.id_menu');
			$data = $this->db->get();
			if($data->num_rows() > 0)
			{
				return $data->result_array();
			}
		}	
	}
	
	function menuadmin($id)
	{
		if($this->session->userdata("logged"))
		{
			$this->db->where("menu_admin_role_access.id_main",$id);
			$this->db->select("menu_admin.*");
			$this->db->from("menu_admin_role_access");
			$this->db->join("menu_admin",'menu_admin.id_main=menu_admin_role_access.id_menu');
			$this->db->group_by("menu_admin.nama_menu");
			$data = $this->db->get();
			if($data->num_rows() > 0)
			{
				return $data->result_array();
			}
		}
	}
	
	function menuadminUnselected($id)
	{
		if($this->session->userdata("logged"))
		{
			$sQuery = "SELECT * FROM menu_admin WHERE id_main NOT IN ( SELECT id_menu FROM menu_admin_role_access WHERE id_main = ".$id.")";
			$data = $this->db->query($sQuery);
			if($data->num_rows() > 0)
			{
				return $data->result_array();
			}
			
		}
	}
	
	function updateaccessmenu($r)
	{
		if($this->session->userdata("logged"))
		{
			$this->db->where('id_main', intval($r["id_main"]));
			$data = $this->db->delete('menu_admin_role_access'); 
			for($i=0;$i<count($r["id_menu"]);$i++)
			{
				$Insert = array(
					"id_main"	=> $r["id_main"],
					"id_menu"	=> intval($r["id_menu"][$i])
				);
				$data = $this->db->insert("menu_admin_role_access",$Insert);
				unset($Insert);
			}
			return $data;
		}
	}
	
	function deleteImage($r)
	{
		$this->db->limit("1");
		$this->db->where("username",$r);
		$this->db->select("gambar");
		$this->db->from("users");
		$data = $this->db->get();
		if($data->num_rows() > 0)
		{
			$file = $data->result_array();
			unset($data);
			if(file_exists("public/images/img_uploaded/imgprofil_".$file[0]['gambar']))
			{
				unlink("public/images/img_uploaded/imgprofil_".$file[0]['gambar']);
			}
		}
		return false;
	}
}
?>
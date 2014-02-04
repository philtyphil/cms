<?php
class Menuadminmodel extends CI_Model{
	private $db;
	function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default', TRUE);
	}
	
	function getlistmenu()
	{
	   if($this->session->userdata('logged'))
       {
		
           $aColumns = array('id_main','nama_menu','link','aktif','icon');
	
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "id_main";
		
		/* DB table to use */
		$sTable = "menu_admin";
	
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
		$this->db->cache_on();
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
            $sQueryTotal = "Select id_main FROM " . $sTable . " " .$sWhere;
            $FetchsQuery = $this->db->query($sQueryTotal)->result_array();
            $iFilteredTotal = count($FetchsQuery);
        }
        else
        {
            $iFilteredTotal = $iTotal;
        }
		$this->db->cache_off();
		
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
			$this->db->where("id_main",$value["id_main"]);
			$this->db->select("*");
			$this->db->from("submenu_admin");
			$subAdmin = $this->db->get();
            $row    = array();
            $row[]  = $value['nama_menu'];
			$row[]  = $value['link'];
            $row[]  = $value['aktif'];
            $row[]  = "<i class='".$value['icon']."'> - ".$value['icon'];
            $row[]  = "<a href='".config_item('base_url')."menu/edit/".$value['id_main']."'><i class='icon-edit'></i></a>    <a href='#' onclick='deletemenu(\"".$value['id_main']."\");'><i class='icon-remove'></i></a>";
			$output['aaData'][] = $row;
			if($subAdmin->num_rows() > 0)
			{
				foreach($subAdmin->result_array() as $id => $v)
				{
					$row = array();
					$row[]	= "&#8594;  " . $v["nama_sub"];
					$row[]	= $v["link_sub"];
					$row[]	= $v["aktif"];
					$row[]  = "<i class='".$v['icon']."'> - ".$v['icon'];
					$row[]  = "<a href='".config_item('base_url')."menu/editsub/".$v['id_sub']."'><i class='icon-edit'></i></a>    <a href='#' onclick='deletesub(\"".$v['id_sub']."\");'><i class='icon-remove'></i></a>";
					$output['aaData'][] = $row;
				}
			}
			
		}
        return $output;
	   } /** End Of Session **/
    } /** End Of Function GetUsers **/
	
	function getmenu($roleAccess)
	{
		$this->db->order_by("menu_admin.id_main","ASC");
		$this->db->where("menu_admin_role_access.id_main",$roleAccess);
		$this->db->where("menu_admin.aktif","Y");
		$this->db->select("menu_admin.id_main,menu_admin.nama_menu,menu_admin.link,menu_admin.icon");
		$this->db->from("menu_admin");
		$this->db->join("menu_admin_role_access", 'menu_admin_role_access.id_menu = menu_admin.id_main');
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
	
	function getsubmenu($role,$id)
	{
		if(isset($role))
		{
			$this->db->where("id_main",$id);
			$this->db->select("*");
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
	
	function deletemenu($id)
	{
		$this->db->where('id_main',$id);
		$data = $this->db->delete('menu_admin');
		if($data)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
		function deletesubmenu($id)
	{
		$this->db->where('id_sub',$id);
		$data = $this->db->delete('submenu_admin');
		if($data)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function geteditmenulist($id)
	{
		$this->db->where("id_main",$id);
		$this->db->limit("1");
		$this->db->select("*");
		$this->db->from("menu_admin");
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
    
	function geteditmenusublist($id)
	{
		$this->db->where("id_sub",$id);
		$this->db->limit("1");
		$this->db->select("*");
		$this->db->from("submenu_admin");
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
	function geteditmenusubwebsitelist($id)
	{
		$this->db->where("id_sub",$id);
		$this->db->limit("1");
		$this->db->select("*");
		$this->db->from("submenu");
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
    function editsave($r)
    {
        if($this->session->userdata("logged"))
        {
            $data = array(
                "icon"   => $r['icon'],
                "nama_menu"   => $r['namamenu'],
                "link"   => $r['link'],
                "aktif"  => $r['aktif']
            );
            $this->db->where("id_main",$r['id']);
            $data = $this->db->update('menu_admin',$data);
			
			/*---------------
			| Awalnya semua submenu di bikin aktif=N dengan id_main = $r['id']
			----------------*/
			$dataUpdate = array(
				"aktif"	=> 'N'
			);
			$this->db->where("id_main",$r['id']);
			$update = $this->db->update("submenu_admin",$dataUpdate);
			/*---------------
			| Lalu, di update jadi aktif=Y (sesuai yang terselect)
			----------------*/
			
			for($i=0;$i<count($r['submenu']);$i++)
			{
				$status = array(
					"aktif"	=> "Y",
					"id_main"	=> $r['id']
				);
				$this->db->where("id_sub",$r['submenu'][$i]);
			$submenu = $this->db->update("submenu_admin",$status);
			}
			
           if($data && $update && $submenu)
		   {
				return true;
		   }
        }
    }
	
	function editsavesubmenu($r)
    {
        if($this->session->userdata("logged"))
        {
            $data = array(
                "icon"   	=> $r['icon'],
                "nama_sub"  => $r['nama_sub'],
                "link_sub"  => $r['link_sub'],
                "aktif"  	=> $r['aktif']
            );
            $this->db->where("id_sub",$r['id_sub']);
            $data = $this->db->update('submenu_admin',$data);
            return $data;
        }
    }
	
	function getrole($role,$menu)
	{
		if($this->session->userdata("logged"))
		{
			$this->db->select("id_menu_role_access");
			$this->db->from("menu_admin_role_access");
			$this->db->join("menu_admin","menu_admin.id_main = menu_admin_role_access.id_menu");
			$this->db->where("menu_admin_role_access.id_main",$role);
			$this->db->where("menu_admin.class",$menu);
			$data = $this->db->get();
			return $data;
		}
	}
	
	function saveAdd($f)
	{
		if($this->session->userdata("logged"))
		{
			$insertData = array(
				"nama_menu"	=> $f['nama_menu'],
				"class"		=> $f['class'],
				"link"		=> $f['link'],
				"icon"		=> $f['icon'],
				"aktif"		=> "Y"
			);
			$data = $this->db->insert("menu_admin",$insertData);
			return $data;
		}
	}
	
	function saveAddSubAdmin($f)
	{
		if($this->session->userdata("logged"))
		{
			$insertData = array(
				"id_main"		=> $f['id_main'],
				"link_sub"		=> $f['link_sub'],
				"icon"			=> $f['icon'],
				"aktif"			=> $f['aktif'],
				"nama_sub"		=> $f['nama_sub'],
				"description"	=> $f['description']
			);
			$data = $this->db->insert("submenu_admin",$insertData);
			return $data;
		}
	}
	
	function cekClass($o)
	{
		if($this->session->userdata("logged"))
		{
			$this->db->where("class",$o);
			$this->db->select("class");
			$this->db->from("menu_admin");
			$data = $this->db->get();
			if($data->num_rows() > 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	
	function submenu()
	{
		if($this->session->userdata("logged"))
		{
			$this->db->order_by("nama_sub","desc");
			$this->db->select("*");
			$this->db->from("submenu_admin");
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
	
	function getlistmenuwebsite()
	{
	   if($this->session->userdata('logged'))
       {
		
           $aColumns = array('id_main','nama_menu','link','aktif','icon');
	
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "id_main";
		
		/* DB table to use */
		$sTable = "mainmenu";
	
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
		$this->db->cache_on();
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
            $sQueryTotal = "Select id_main FROM " . $sTable . " " .$sWhere;
            $FetchsQuery = $this->db->query($sQueryTotal)->result_array();
            $iFilteredTotal = count($FetchsQuery);
        }
        else
        {
            $iFilteredTotal = $iTotal;
        }
		$this->db->cache_off();
		
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
			$this->db->where("id_main",$value["id_main"]);
			$this->db->select("*");
			$this->db->from("submenu");
			$subAdmin = $this->db->get();
            $row    = array();
            $row[]  = $value['nama_menu'];
            $row[]  = $value['link'];
            $row[]  = $value['aktif'];
			$row[]  = "<i class='".$value['icon']."'> - ".$value['icon'];
            $row[]  = "<a href='".config_item('base_url')."menu/editmenuwebsite/".$value['id_main']."'><i class='icon-edit'></i></a>    <a href='#' onclick='deletemenuwebsite(\"".$value['id_main']."\");'><i class='icon-remove'></i></a>";
			$output['aaData'][] = $row;
			if($subAdmin->num_rows() > 0)
			{
				foreach($subAdmin->result_array() as $id => $v)
				{
					$row = array();
					$row[]	= "&#8594;  " . $v["nama_sub"];
					$row[]	= $v["link_sub"];
					$row[]	= $v["aktif"];
					$row[]	= "-";
					$row[]  = "<a href='".config_item('base_url')."menu/editsubwebsite/".$v['id_sub']."'><i class='icon-edit'></i></a>    <a href='#' onclick='deletesubwebsite(\"".$v['id_sub']."\");'><i class='icon-remove'></i></a>";
					$output['aaData'][] = $row;
				}
			}
		}
        return $output;
	   } /** End Of Session **/
    } /** End Of Function GetUsers **/
	
	function mainmenu()
	{
		if($this->session->userdata("logged"))
		{
			$this->db->where("aktif",'Y');
			$this->db->select("*");
			$this->db->from("mainmenu");
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
	
	function mainmenuadmin()
	{
		if($this->session->userdata("logged"))
		{
			$this->db->where("aktif",'Y');
			$this->db->select("*");
			$this->db->from("menu_admin");
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
	
	function getsubmenuadmin()
	{
		if($this->session->userdata("logged"))
		{
			$this->db->from("submenu_admin");
			$this->db->select("*");
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
	
	function submenuwebsite()
	{
		if($this->session->userdata("logged"))
		{
			$this->db->order_by("nama_sub","desc");
			$this->db->select("*");
			$this->db->from("submenu");
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
	
	function saveAddMenuWebsite($r)
	{
		if($this->session->userdata("logged"))
		{
			$Insert = array(
				'nama_menu'		=> $r['nama_menu'],
				'link'			=> $r['link_sub'],
				'icon'			=> $r['icon'],
				'aktif'			=> $r['aktif']
			);
			$data = $this->db->insert("mainmenu",$Insert);
			unset($Insert);
			$this->db->select("id_main");
			$this->db->limit("1");
			$this->db->order_by("id_main","DESC");
			$this->db->from("mainmenu");
			$id	= $this->db->get()->result_array();
			if($data && $id)
			{
				$submenu = explode(",",$r['sub_menu']);
				if(count($submenu) <= 1|| empty($submenu))
				{
					$update = array(
							"aktif" 	=> 'Y',
							"id_main"	=> $id[0]['id_main']
						);
					$this->db->where('nama_sub',$r['sub_menu']);
					$data = $this->db->update('submenu',$update);
				}
				else
				{
					for($i=0;$i<count($submenu);$i++)
					{
						$update = array(
							"aktif" 	=> 'Y',
							"id_main"	=> $id[0]['id_main']
						);
						$this->db->where('nama_sub',$submenu[$i]);
						$data = $this->db->update('submenu',$update);
						unset($update);unset($submenu);
					}
				}
				
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
	}
	
	function deletemenuwebsite($id)
	{
		if($this->session->userdata("logged"))
		{
			$this->db->where("id_main",$id);
			$data = $this->db->delete("mainmenu");
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
	
	function geteditmenuwebsitelist($id)
	{
		$this->db->where("id_main",$id);
		$this->db->limit("1");
		$this->db->select("*");
		$this->db->from("mainmenu");
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
	
	function getsubmenuwebsite($id)
	{
		if($this->session->userdata("logged"))
		{
			$this->db->where("aktif",'Y');
			$this->db->where("id_main",$id);
			$this->db->from("submenu");
			$this->db->select("*");
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
	
	function getAllSubmenu($id)
	{
		if($this->session->userdata("logged"))
		{	
			$query = "select * from submenu where (id_main != ".$id.") or (id_main = ".$id." AND aktif = 'N')";
			$data = $this->db->query($query);
			if($data)
			{
				return $data->result_array();
			}
			else
			{
				return false;
			}
		}
	}
	
	    function editmenuwebsite($r)
    {
        if($this->session->userdata("logged"))
        {
            $data = array(
                "icon"   => $r['icon'],
                "nama_menu"   => $r['namamenu'],
                "link"   => $r['link'],
                "aktif"  => $r['aktif']
            );
            $this->db->where("id_main",$r['id']);
            $data = $this->db->update('mainmenu',$data);
			
			
			if(isset($r["submenu"]) && $r["submenu"] != "")
			{
				/*---------------
				| Awalnya semua submenu di bikin non aktif (aktif=N) dengan id_main = $r['id']
				----------------*/
				$dataUpdate = array(
					"aktif"	=> 'N'
				);
				$this->db->where("id_main",$r['id']);
				$update = $this->db->update("submenu",$dataUpdate);
				/*---------------
				| Lalu, di update jadi aktif=Y (sesuai yang terselect)
				----------------*/
					for($i=0;$i<count($r['submenu']);$i++)
					{
						$status = array(
							"aktif"	=> "Y",
							"id_main"	=> $r['id']
						);
						$this->db->where("id_sub",$r['submenu'][$i]);
						$submenu = $this->db->update("submenu",$status);
					}
			}
			
           return true;
        }
    }
	
	function deletesubmenuwebsite($id)
	{
		if($this->session->userdata("logged"))
		{
			$this->db->where("id_sub",$id);
			$data = $this->db->delete("submenu");
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
	
	function editsavesubmenuwebsite($r)
    {
        if($this->session->userdata("logged"))
        {
            $data = array(
                "nama_sub"  => $r['nama_sub'],
                "link_sub"  => $r['link_sub']."/".$r['id_sub']."/".$r['nama_sub'].".html",
                "aktif"  	=> $r['aktif']
            );
            $this->db->where("id_sub",$r['id_sub']);
            $data = $this->db->update('submenu',$data);
            return $data;
        }
    }
	
	function saveAddMenu($f)
	{
		if($this->session->userdata("logged"))
		{
			$Insert = array(
				"nama_sub"	=> $f['nama_sub'],
				"link_sub"	=> $f['link_sub'],
				"icon"		=> $f['icon'],
				"description"	=> $f['description'],
				"id_main"	=> $f['id_main'],
				"aktif"	=> $f['aktif'],
			);
			$data = $this->db->insert("submenu_admin",$Insert);
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
	
}
?>
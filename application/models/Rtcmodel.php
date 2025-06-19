<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Rtcmodel extends CI_Model {

	public function __construct()
	{
		$this->load->database(); 
	}

	public function selectData($table)
	{
		$query = $this->db->get($table);
		return $query->result_array();
	}

	public function selectWithQuery($str)
	{
		$query = $this->db->query($str);
		return $query->result_array();
	}

	public function selectWithQueryOne($str)
	{
		$query = $this->db->query($str);
		return $query->row_array();
	}

	public function selectWhere($table,$where)
	{
		$query = $this->db->get_where($table,$where);
		return $query->result_array();
	}

	public function selectDataone($table,$where)
	{
		$query = $this->db->get_where($table,$where);
		return $query->row_array();
	}

	public function deleteData($table,$id)
	{
		$this->db->where($id);
		return $this->db->delete($table);
	}

	public function insertData($table,$data)
	{
		$result = $this->db->insert($table,$data);
		return $result;
	}

	public function updateData($table,$data,$where)
	{
		$result = $this->db->update($table,$data,$where);
		return $result;
	}

	public function selectjumlahWhere($table,$where)
	{
		$query = $this->db->get_where($table,$where);
		return $query->num_rows();
	}

	public function selectColumnValue($table,$where,$column)
	{
		$this->db->select($column);
		$query = $this->db->get_where($table,$where);
		return $query->row_array()[$column];
	}

	public function buatKode($table,$column,$prefix)
	{
		$this->db->select('RIGHT('.$column.',4) as kode',FALSE);
		$this->db->order_by('created_at','DESC');
		$this->db->where('YEAR(created_at)',date('Y'));
		$this->db->where('MONTH(created_at)',date('m'));
		$this->db->limit(1);
		$query = $this->db->get($table);
		if ($query->num_rows() <> 0)
		{
			$data = $query->row();
			$kode = intval($data->kode) + 1;
		}else{
			$kode=1;
		}

		$kodemax= str_pad($kode,4,"0", STR_PAD_LEFT);
		$kodejadi=$prefix.date('Y').date('m').$kodemax;
		return $kodejadi;
	}

	public function buatKodeInv($table)
	{
		
		$query = $this->db->get($table);
		if ($query->num_rows() <> 0)
		{
			$data = $query->row();
			$kode =$query->num_rows() + 1;
		}else{
			$kode=1;
		}

		$kodemax= str_pad($kode,4,"0", STR_PAD_LEFT);
		$kodejadi= $kodemax;
		return $kodejadi;
	}

	public function deleteDataSoft($table,$id)
	{
		return $this->db->update($table,['deleted_at'=>date('Y-m-d H:i:s'),'deleted_by'=>$this->session->userdata('id')],$id);
	}

	

	

}
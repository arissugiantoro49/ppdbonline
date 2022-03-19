<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_siswa extends CI_Model
{

	function base_biodata($sess)
	{
		return $this->db->get_where('tbl_siswa', "no_pendaftaran='$sess'")->row();
	}

	function cek_nilai($sess)
	{
		return $this->db->get_where('tbl_nilai', "no_pendaftaran='$sess'")->row();
	}

	function ubah_biodata()
	{
		$data = array(
			'no_pendaftaran'		=> $this->input->post('no_pendaftaran'),
			'nisn'					=> $this->input->post('nisn'),
			'nik'					=> $this->input->post('nik'),
			'nama_lengkap'			=> $this->input->post('nama_lengkap'),
			'jk'					=> $this->input->post('jk'),
			'tempat_lahir'			=> $this->input->post('tempat_lahir'),
			'tgl_lahir'				=> $this->input->post('tgl_lahir'),
			'agama'					=> $this->input->post('agama'),
			'no_hp_siswa'			=> $this->input->post('no_hp_siswa'),
			'alamat_siswa'			=> $this->input->post('alamat_siswa'),
			'desa'					=> $this->input->post('desa'),
			'kec'					=> $this->input->post('kec'),
			'kab'					=> $this->input->post('kab'),
			'prov'					=> $this->input->post('prov'),
			'kode_pos'				=> $this->input->post('kode_pos'),
			'nama_ayah'				=> $this->input->post('nama_ayah'),
			'nik_ayah'				=> $this->input->post('nik_ayah'),
			'pdd_ayah'				=> $this->input->post('pdd_ayah'),
			'pekerjaan_ayah'		=> $this->input->post('pekerjaan_ayah'),
			'penghasilan_ayah'		=> $this->input->post('penghasilan_ayah'),
			'nama_ibu'				=> $this->input->post('nama_ibu'),
			'nik_ibu'				=> $this->input->post('nik_ibu'),
			'pdd_ibu'				=> $this->input->post('pdd_ibu'),
			'pekerjaan_ibu'			=> $this->input->post('pekerjaan_ibu'),
			'penghasilan_ibu'		=> $this->input->post('penghasilan_ibu'),
			'nama_wali'				=> $this->input->post('nama_wali'),
			'nik_wali'				=> $this->input->post('nik_wali'),
			'pdd_wali'				=> $this->input->post('pdd_wali'),
			'pekerjaan_wali'		=> $this->input->post('pekerjaan_wali'),
			'penghasilan_wali'		=> $this->input->post('penghasilan_wali'),
			'no_kks'				=> $this->input->post('no_kks'),
			'no_pkh'				=> $this->input->post('no_pkh'),
			'no_kip'				=> $this->input->post('no_kip'),
			'nama_sekolah'			=> $this->input->post('nama_sekolah'),
			'status_sekolah'		=> $this->input->post('status_sekolah'),
			'npsn_sekolah'			=> $this->input->post('npsn_sekolah')
		);

		$no = $data['no_pendaftaran'];
		$fields = ["dokumen_kk", "dokumen_akte_kelahiran", "dokumen_skl", "dokumen_kartu_bantuan"];

		foreach ($fields as $field) {
			if (
				!$_FILES[$field]['name'] == "" &&
				!$_FILES[$field]['size'] == 0
			) {
				$file_name = $this->upload_dokumen($field, $no . "_$field");
				$data[$field] = $file_name;
			}
		}

		return $this->db->update('tbl_siswa', $data, array('no_pendaftaran' => $data['no_pendaftaran']));
	}

	function ubah_nilai()
	{
		$data = array(
			'matematika_raport'		=> $this->input->post('matematika_raport'),
			'ipa_raport'					=> $this->input->post('ipa_raport'),
			'pai_raport'					=> $this->input->post('pai_raport'),
			'bahasa_indonesia_raport'		=> $this->input->post('bahasa_indonesia_raport'),

			'matematika_usbn'			=> $this->input->post('matematika_usbn'),
			'ipa_usbn'					=> $this->input->post('ipa_usbn'),
			'pai_usbn'					=> $this->input->post('pai_usbn'),
			'bindo_usbn'				=> $this->input->post('bindo_usbn'),

			'matematika_uas'			=> $this->input->post('matematika_uas'),
			'ipa_uas'					=> $this->input->post('ipa_uas'),
			'pai_uas'					=> $this->input->post('pai_uas'),
			'bindo_uas'					=> $this->input->post('bindo_uas'),

			'nilai_prestasi'			=> $this->input->post('nilai_prestasi'),
		);

		$no_pendaftaran = $this->input->post('no_pendaftaran');
		$fields = ["dok_uas", "dok_usbn", "dok_raport", "dok_prestasi"];

		foreach ($fields as $field) {
			if (
				!$_FILES[$field]['name'] == "" &&
				!$_FILES[$field]['size'] == 0
			) {
				$file_name = $this->upload_dokumen($field, $no . "_$field");
				$data[$field] = $file_name;
			}
		}
		return $this->db->update('tbl_nilai', $data, array('no_pendaftaran' => $no_pendaftaran));
	}

	private function upload_dokumen($field, $new_name)
	{
		$uploadOk = 1;
		$target_dir = "./uploads/dokumen/";
		$fileType = strtolower(pathinfo(basename($_FILES[$field]["name"]), PATHINFO_EXTENSION));
		$new_name = $new_name . "." . $fileType;

		if ($_FILES[$field]["size"] > 500000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}

		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		} else {
			move_uploaded_file($_FILES[$field]["tmp_name"], $target_dir .  $new_name);
		}

		return $new_name;
	}

	function get_data()
	{
		return json_encode($this->db->get_where('tbl_siswa', "no_pendaftaran='" . $this->session->userdata('no_pendaftaran') . "'")->row());
	}

	function get_nilai()
	{
		return json_encode($this->db->get_where('tbl_nilai', "no_pendaftaran='" . $this->session->userdata('no_pendaftaran') . "'")->row());
	}

	function get_fy()
	{
		return $this->db->get_where('tbl_web', "id_web=1")->row()->tapel;
	}

	function get_print($menu = '', $data = '')
	{
		switch ($menu) {
			case 'passed':
				return $this->db->like('tgl_siswa', date('Y'), 'after')->get_where('tbl_siswa', "no_pendaftaran='$data'")->row();
				break;

			case 'announcement':
				return $this->db->get_where('tbl_pengumuman', "id_pengumuman='1'")->row();
				break;

			default:
				# code...
				break;
		}
	}

	function get_val($type, $sess, $subject)
	{
		switch ($type) {
			default:
				# code...
				break;
		}
	}

	function statistik_data()
	{
	}
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Model_web extends CI_Model
{

	function web_utama()
	{
		return $this->db->get_where('tbl_web', "id_web='1'")->row();
	}

	function pendaftaran($menu = '', $data = '')
	{
		switch ($menu) {
			case 'daftar':
				$data = (object) $data;
				$data_temp = (object) $data;
				$nis = $data->post('nis');
				$data = array(
					'no_pendaftaran'	=> $data->post('nis'),
					'password'			=> $data->post('nisn'),
					'komp_ahli'			=> $data->post('komp_ahli'),
					'nisn'				=> $data->post('nisn'),
					'nik'				=> $data->post('nik'),
					'nama_lengkap'		=> $data->post('nama_lengkap'),
					'jk'				=> $data->post('jk'),
					'tempat_lahir'		=> $data->post('tempat_lahir'),
					'tgl_lahir'			=> $data->post('tgl_lahir') . "-" . $data->post('bln_lahir') . "-" . $data->post('thn_lahir'),
					'agama'				=> $data->post('agama'),
					'status_keluarga'	=> $data->post('status_keluarga'),
					'anak_ke'			=> $data->post('anak_ke'),
					'jml_saudara'	    => $data->post('jml_saudara'),
					'hobi'				=> $data->post('hobi'),
					'cita'				=> $data->post('cita'),
					'paud'				=> $data->post('paud'),
					'tk'				=> $data->post('tk'),
					'no_hp_siswa'		=> $data->post('no_hp_siswa'),
					'jenis_tinggal'		=> $data->post('jenis_tinggal'),
					'alamat_siswa'		=> $data->post('alamat_siswa'),
					'desa'				=> $data->post('desa'),
					'kec'				=> $data->post('kec'),
					'kab'				=> $data->post('kab'),
					'prov'				=> $data->post('prov'),
					'kode_pos'			=> $data->post('kode_pos'),
					'jarak'				=> $data->post('jarak'),
					'trans'				=> $data->post('trans'),
					'no_kk'				=> $data->post('no_kk'),
					'kepala_keluarga'	=> $data->post('kepala_keluarga'),
					'nama_ayah'			=> $data->post('nama_ayah'),
					'nik_ayah'			=> $data->post('nik_ayah'),
					'th_lahir_ayah'		=> $data->post('th_lahir_ayah'),
					'status_ayah'		=> $data->post('status_ayah'),
					'pdd_ayah'			=> $data->post('pdd_ayah'),
					'pekerjaan_ayah'	=> $data->post('pekerjaan_ayah'),
					'penghasilan_ayah'	=> $data->post('penghasilan_ayah'),
					'nama_ibu'			=> $data->post('nama_ibu'),
					'nik_ibu'			=> $data->post('nik_ibu'),
					'th_lahir_ibu'		=> $data->post('th_lahir_ibu'),
					'status_ibu'		=> $data->post('status_ibu'),
					'pdd_ibu'			=> $data->post('pdd_ibu'),
					'pekerjaan_ibu'		=> $data->post('pekerjaan_ibu'),
					'penghasilan_ibu'	=> $data->post('penghasilan_ibu'),
					'nama_wali'			=> $data->post('nama_wali'),
					'nik_wali'			=> $data->post('nik_wali'),
					'th_lahir_wali'		=> $data->post('th_lahir_wali'),
					'pdd_wali'			=> $data->post('pdd_wali'),
					'pekerjaan_wali'	=> $data->post('pekerjaan_wali'),
					'penghasilan_wali'	=> $data->post('penghasilan_wali'),
					'no_hp_ortu'		=> $data->post('no_hp_ortu'),
					'no_kks'			=> $data->post('no_kks'),
					'no_pkh'			=> $data->post('no_pkh'),
					'no_kip'			=> $data->post('no_kip'),
					'nama_sekolah'		=> $data->post('nama_sekolah'),
					'jenjang_sekolah'	=> $data->post('jenjang_sekolah'),
					'status_sekolah'	=> $data->post('status_sekolah'),
					'npsn_sekolah'		=> $data->post('npsn_sekolah'),
					'lokasi_sekolah'	=> $data->post('lokasi_sekolah'),
					'tgl_siswa'			=> date('Y-m-d H:i:s')
				);

				$data1 = array(
					'rata_rata_raport'				=> $data_temp->post('rata_rata_raport'),
					'rata_rata_usbn'				=> $data_temp->post('rata_rata_usbn'),
					'rata_rata_uas'				=> $data_temp->post('rata_rata_uas'),

					'nilai_prestasi'			=> $data_temp->post('nilai_prestasi'),
					'no_pendaftaran'			=> $data['no_pendaftaran']
				);

				$data1['dok_raport'] = $this->upload_dokumen("dok_raport", $nis . '_dok_raport');
				$data1['dok_usbn'] = $this->upload_dokumen("dok_usbn", $nis . '_dok_usbn');
				$data1['dok_uas'] = $this->upload_dokumen("dok_uas", $nis . '_dok_uas');
				$data1['dok_prestasi'] = $this->upload_dokumen("dok_prestasi", $nis . '_dok_prestasi');


				$dokumen_kk = $this->upload_dokumen("dokumen_kk", $nis . "_kk");
				$data["dokumen_kk"] = $dokumen_kk;

				$dokumen_akte_kelahiran = $this->upload_dokumen("dokumen_akte_kelahiran", $nis . "_akte_kelahiran");
				$data["dokumen_akte_kelahiran"] = $dokumen_akte_kelahiran;

				$dokumen_skl = $this->upload_dokumen("dokumen_skl", $nis . "_skl");
				$data["dokumen_skl"] = $dokumen_skl;
				
				if (
					!$_FILES['dokumen_kartu_bantuan']['name'] == "" &&
					!$_FILES['dokumen_kartu_bantuan']['size'] == 0
				) {
					$dokumen_kartu_bantuan = $this->upload_dokumen("dokumen_kartu_bantuan", $nis . "_kartu_bantuan");
					$data["dokumen_kartu_bantuan"] = $dokumen_kartu_bantuan;

				}

				$this->db->insert('tbl_nilai', $data1);
				$this->db->insert('tbl_siswa', $data);
				return $this->db->insert_id();
				break;

			case 'id_baru':
				$no_max = $this->db->select_max('no_pendaftaran', 'kode')->get('tbl_siswa')->row();
				$no_max = $no_max->kode;
				$no_max = (int) substr($no_max, 6) + 1;
				return date('Y-') . sprintf("%03s", $no_max);
				break;

			case 'status_ppdb':
				return $this->db->get_where('tbl_web', "id_web='1'")->row();
				break;

			case 'v_pdd':
				return $this->db->order_by('id_pdd', 'ASC')->get('tbl_pdd')->result();
				break;

			case 'v_pekerjaan_ayah':
				return $this->db->where('ket_pekerjaan', 'ayah')->order_by('id_pekerjaan', 'ASC')->get('tbl_pekerjaan')->result();
				break;

			

			case 'v_pekerjaan_ibu':
				return $this->db->where('ket_pekerjaan', 'ibu')->order_by('id_pekerjaan', 'ASC')->get('tbl_pekerjaan')->result();
				break;

			case 'v_pekerjaan_wali':
				return $this->db->order_by('id_pekerjaan', 'ASC')->group_by('nama_pekerjaan')->get('tbl_pekerjaan')->result();
				break;

			case 'v_penghasilan':
				return $this->db->order_by('id_penghasilan', 'ASC')->get('tbl_penghasilan')->result();
				break;

			default:
				# code...
				break;
		}
	}

	function auth($menu = '', $data = '')
	{
		switch ($menu) {
			case 'cek-masuk':
				$query = $this->db->where($data)->get('tbl_siswa');
				return array(
					'res'	=> $query->row(),
					'sum'	=> $query->num_rows()
				);
				break;

			default:
				# code...
				break;
		}
	}

	private function upload_dokumen($field, $new_name)
	{
		$uploadOk = 1;
		$target_dir = "./uploads/dokumen/";
		$fileType = strtolower(pathinfo(basename($_FILES[$field]["name"]), PATHINFO_EXTENSION));
		$new_name = $new_name . "." . $fileType;

		if ($_FILES[$field]["size"] > 5000000) {
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
}

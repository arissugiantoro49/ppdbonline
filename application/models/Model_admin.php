<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Model_admin extends CI_Model
{

	function base($menu = '', $data = '')
	{
		switch ($menu) {
			case 'bio':
				// var_dump($data); exit;
				return $this->db->get_where('tbl_user', "username='$data'")->row();
				break;

			case 'status-ppdb':
				return $this->db->get_where('tbl_web', "id_web='1'")->row();
				break;

			default:
				# code...
				break;
		}
	}

	function get_kriteria() {
		return $this->db->get('tbl_kriteria');
	}

	function get_tabel_yi($thn) {
		$sqrt = [
			'c1' => 0,'c2' => 0, 'c3' => 0, 'c4' => 0,'c5' => 0
		];

		foreach ($this->admin->verifikasi('siswa', $thn)->ori->result() as $row) {
			$temp = [
				'nama' => $row->nama_lengkap,
				'c1' => ($row->matematika_raport + $row->ipa_raport + $row->bahasa_indonesia_raport + $row->pai_raport) / 4,
				'c2' => ($row->matematika_usbn + $row->ipa_usbn + $row->bindo_usbn + $row->pai_usbn) / 4,
				'c3' => ($row->matematika_uas + $row->ipa_uas + $row->bindo_uas + $row->pai_uas) / 4,
				'c4' => $row->nilai_prestasi,
				'c5' => 50
			];
			$alternatif[$row->id_siswa] = $temp;

			$sqrt['c1'] += pow($temp['c1'], 2);
			$sqrt['c2'] += pow($temp['c2'], 2);
			$sqrt['c3'] += pow($temp['c3'], 2);
			$sqrt['c4'] += pow($temp['c4'], 2);
			$sqrt['c5'] += pow($temp['c5'], 2);
		}

		$sqrt['c1'] = sqrt($sqrt['c1']);
		$sqrt['c2'] = sqrt($sqrt['c2']);
		$sqrt['c3'] = sqrt($sqrt['c3']);
		$sqrt['c4'] = sqrt($sqrt['c4']);
		$sqrt['c5'] = sqrt($sqrt['c5']);

		foreach ($alternatif as $key => $value) {
			$normalisasi[$key]['c1'] = $value['c1'] / $sqrt['c1'];
			$normalisasi[$key]['c2'] = $value['c2'] / $sqrt['c2'];
			$normalisasi[$key]['c3'] = $value['c3'] / $sqrt['c3'];
			$normalisasi[$key]['c4'] = $value['c4'] / $sqrt['c4'];
			$normalisasi[$key]['c5'] = $value['c5'] / $sqrt['c5'];
		}

		$kriteria = $this->admin->get_kriteria()->result_array();
		
		foreach ($normalisasi as $key => $value) {
			$ternormalisasi[$key]['c1'] = $value['c1'] * $kriteria[0]['bobot'];
			$ternormalisasi[$key]['c2'] = $value['c2'] * $kriteria[1]['bobot'];
			$ternormalisasi[$key]['c3'] = $value['c3'] * $kriteria[2]['bobot'];
			$ternormalisasi[$key]['c4'] = $value['c4'] * $kriteria[3]['bobot'];
			$ternormalisasi[$key]['c5'] = $value['c5'] * $kriteria[4]['bobot'];
		}

		foreach ($ternormalisasi as $key => $value) {
			$optimasi[$key]['max'] = $value['c1'] + $value['c2'] + $value['c3'];
			$optimasi[$key]['min'] = $value['c4'] + $value['c5'];
			$optimasi[$key]['yi'] = $optimasi[$key]['max'] - $optimasi[$key]['min'];
			$yi[] = $optimasi[$key]['max'] - $optimasi[$key]['min'];
		}
		array_unique($yi);
		rsort($yi);
		$no = 1;
		foreach ($yi as $value) {
			$tabel_yi[] = [
				'optimasi' => $value,
				'rank' => $no++
			];
		}

		foreach($optimasi as $key => $value) {
			$rank[$key]['optimasi'] = $value['yi'];
			$rank[$key]['rank'] = array_search($value['yi'], array_column($tabel_yi, 'optimasi')) + 1;
		}
		return $rank;
	}

	function get_siswa($no_pendaftaran) {
		return json_encode($this->db->get_where('tbl_siswa', "no_pendaftaran='$no_pendaftaran'")->row());
	}

	function get_detail_soal($id_soal) {
		return json_encode($this->db->get_where('tbl_soal', "id_soal='$id_soal'")->row());
	}

	function get_list_soal($text) {
		return json_encode($this->db->query("SELECT * FROM tbl_soal WHERE MATCH (kode, soal, opsi_a, opsi_b, opsi_c, opsi_d, opsi_e) AGAINST ('+$text*' IN BOOLEAN MODE)")->result_array());
	}

	function get_detail_ujian($id_ujian) {

		return json_encode($this->db->get_where('tbl_ujian', "id_ujian='$id_ujian'")->row());
	}

	function get_soal() {
		return $this->db->get('tbl_soal');
	}

	function get_ujian() {
		return $this->db->query("SELECT u.*, COUNT(d.id_ujian) AS jumlah_soal FROM tbl_ujian u LEFT JOIN tbl_daftar_soal_ujian d USING(id_ujian) GROUP BY u.id_ujian");
	}

	function tambah_daftar_soal_ujian($id_ujian, $id_soal) {
		$result['success'] = false;
		$result['success'] = 'Terjadi kesalahan';
		$data = array('id_ujian' => $id_ujian, 'id_soal' => $id_soal);

		$this->db->from('tbl_daftar_soal_ujian');
		$this->db->where($data);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			$result['message'] = 'Daftar soal sudah ada';
		} else {
			$this->db->flush_cache();
			$this->db->insert('tbl_daftar_soal_ujian', $data);
			$result['success'] = true;
			$result['message'] = 'Berhasil menambahkan soal';
		}

		return json_encode($result);
	}

	public function get_daftar_soal_ujian($id_ujian) {
		$this->db->select('d.id_daftar_soal_ujian, d.id_soal,s.kode, s.soal');
		$this->db->from('tbl_daftar_soal_ujian d');
		$this->db->join('tbl_soal s', 's.id_soal = d.id_soal');
		$this->db->where('d.id_ujian', $id_ujian);
		return json_encode($this->db->get()->result_array());
	}

	function hapus_daftar_soal_ujian($id_daftar_soal_ujian) {
		$this->db->where('id_daftar_soal_ujian', $id_daftar_soal_ujian);
		$this->db->delete('tbl_daftar_soal_ujian');
	}

	function ppdb_status($option, $date)
	{
		switch ($option) {
			case 'tutup':
				$data = array(
					'status_ppdb'	=> 'tutup',
					'tgl_diubah'	=> $date
				);
				return $this->db->update('tbl_web', $data, array('id_web' => '1'));;
				break;

			case 'buka':
				$data = array(
					'status_ppdb'	=> 'buka',
					'tgl_diubah'	=> $date
				);
				return $this->db->update('tbl_web', $data, array('id_web' => '1'));;
				break;

			default:
				# code...
				break;
		}
	}

	function tambah_kriteria($data) {
		$this->db->insert('tbl_kriteria', $data);
	}

	function edit_kriteria($data, $id_kriteria) {
		$this->db->where('id_kriteria', $id_kriteria);
		$this->db->update('tbl_kriteria', $data);
	}

	function hapus_kriteria($id_kriteria) {
		$this->db->where('id_kriteria', $id_kriteria);
		$this->db->delete('tbl_kriteria');
	}

	function tambah_soal($data) {
		$this->db->insert('tbl_soal', $data);
	}

	function edit_soal($data, $id_soal) {
		$this->db->where('id_soal', $id_soal);
		$this->db->update('tbl_soal', $data);
	}

	function hapus_soal($id_soal) {
		$this->db->where('id_soal', $id_soal);
		$this->db->delete('tbl_soal');
	}

	function tambah_ujian($data) {
		$this->db->insert('tbl_ujian', $data);
	}

	function edit_ujian($data, $id_ujian) {
		$this->db->where('id_ujian', $id_ujian);
		$this->db->update('tbl_ujian', $data);
	}

	function hapus_ujian($id_ujian) {
		$this->db->where('id_ujian', $id_ujian);
		$this->db->delete('tbl_ujian');
	}

	function auth($data)
	{
		$query = $this->db->where("username", $data['username'])->where("password", $data['password'])->get('tbl_user');
		return array(
			'res'	=> $query->row(),
			'sum'	=> $query->num_rows()
		);
	}

	function get_announce()
	{
		return $this->db->get_where('tbl_pengumuman', "id_pengumuman='1'")->row();
	}

	function set_announce($act = null, $id = '')
	{
		switch ($act) {
			case 'lulus':
				$data = array(
					'status_pendaftaran'	=> 'lulus'
				);
				return $this->db->update('tbl_siswa', $data, array('no_pendaftaran' => "$id"));
				break;

			case 'tdk_lulus':
				$data = array(
					'status_pendaftaran'	=> 'tidak lulus'
				);
				return $this->db->update('tbl_siswa', $data, array('no_pendaftaran' => "$id"));
				break;

			case 'batal':
				$data = array(
					'status_pendaftaran'	=> null
				);
				return $this->db->update('tbl_siswa', $data, array('no_pendaftaran' => "$id"));
				break;

			case 'thn':
				return $id;
				break;

			default:
				return date('Y');
				break;
		}
	}

	function about_me($menu = '', $data = '')
	{
		switch ($menu) {
			case 'update':
				$old_user = $data['old_user'];
				$data = array(
					'username'		=> $data['username'],
					'nama_lengkap'	=> $data['nama_lengkap'],
					'alamat'		=> $data['alamat'],
					'telp'			=> $data['telp'],
					'email'			=> $data['email'],
					'website'		=> $data['website'],
					'kab_sekolah'	=> $data['kab_sekolah'],
					'ketua_panitia'	=> $data['ketua_panitia'],
					'nip_ketua'		=> $data['nip_ketua'],
					'th_pelajaran'	=> $data['th_pelajaran'],
					'no_surat'		=> $data['no_surat'],
					'kepsek'		=> $data['kepsek'],
					'nip_kepsek'	=> $data['nip_kepsek']
				);
				return $this->db->update('tbl_user', $data, array('username' => $old_user));
				break;

			case 'update-pass':
				$old_user = $data['old_user'];
				$data = array(
					'password'		=> $data['password']
				);
				return $this->db->update('tbl_user', $data, array('username' => $old_user));
				break;

			default:
				# code...
				break;
		}
	}

	function edit_siswa($menu = '', $data = '')
	{
		switch ($menu) {
			case 'update':
				$old_user = $data['old_user'];
				$data = array(
					'no_pendaftaran'		=> $data['no_pendaftaran'],
					'nisn'					=> $data['nisn'],
					'nik'					=> $data['nik'],
					'nama_lengkap'			=> $data['nama_lengkap'],
					'jk'					=> $data['jk'],
					'tempat_lahir'			=> $data['tempat_lahir'],
					'tgl_lahir'				=> $data['tgl_lahir'],
					'agama'					=> $data['agama'],
					'status_keluarga'		=> $data['status_keluarga'],
					'anak_ke'				=> $data['anak_ke'],
					'jml_saudara'			=> $data['jml_saudara'],
					'hobi'					=> $data['hobi'],
					'cita'					=> $data['cita'],
					'paud'					=> $data['paud'],
					'tk'					=> $data['tk'],
					'no_hp_siswa'			=> $data['no_hp_siswa'],
					'jenis_tinggal'			=> $data['jenis_tinggal'],
					'alamat_siswa'			=> $data['alamat_siswa'],
					'desa'					=> $data['desa'],
					'kec'					=> $data['kec'],
					'kab'					=> $data['kab'],
					'prov'					=> $data['prov'],
					'kode_pos'				=> $data['kode_pos'],
					'jarak'					=> $data['jarak'],
					'trans'					=> $data['trans'],
					'no_kk'					=> $data['no_kk'],
					'kepala_keluarga'		=> $data['kepala_keluarga'],
					'nama_ayah'				=> $data['nama_ayah'],
					'th_lahir_ayah'			=> $data['th_lahir_ayah'],
					'status_ayah'			=> $data['status_ayah'],
					'nik_ayah'				=> $data['nik_ayah'],
					'pdd_ayah'				=> $data['pdd_ayah'],
					'pekerjaan_ayah'		=> $data['pekerjaan_ayah'],
					'nama_ibu'				=> $data['nama_ibu'],
					'th_lahir_ibu'			=> $data['th_lahir_ibu'],
					'status_ibu'			=> $data['status_ibu'],
					'nik_ibu'				=> $data['nik_ibu'],
					'pdd_ibu'				=> $data['pdd_ibu'],
					'pekerjaan_ibu'			=> $data['pekerjaan_ibu'],
					'nama_wali'				=> $data['nama_wali'],
					'th_lahir_wali'			=> $data['th_lahir_wali'],
					'nik_wali'				=> $data['nik_wali'],
					'pdd_wali'				=> $data['pdd_wali'],
					'pekerjaan_wali'		=> $data['pekerjaan_wali'],
					'penghasilan_ayah'		=> $data['penghasilan_ayah'],
					'penghasilan_ibu'		=> $data['penghasilan_ibu'],
					'penghasilan_wali'		=> $data['penghasilan_wali'],
					'no_kks'				=> $data['no_kks'],
					'no_pkh'				=> $data['no_pkh'],
					'no_kip'				=> $data['no_kip'],
					'no_hp_ortu'			=> $data['no_hp_ortu'],
					'nama_sekolah'			=> $data['nama_sekolah'],
					'jenjang_sekolah'		=> $data['jenjang_sekolah'],
					'status_sekolah'		=> $data['status_sekolah'],
					'npsn_sekolah'			=> $data['npsn_sekolah'],
					'lokasi_sekolah'		=> $data['lokasi_sekolah'],
					'komp_ahli'				=> $data['komp_ahli']



				);
				return $this->db->update('tbl_siswa', $data, array('no_pendaftaran' => $old_user));
				break;

			default:
				# code...
				break;
		}
	}
function get_kelas (){

	
}
	function verifikasi($menu = '', $thn = '', $status = '')
	{
		switch ($menu) {
			case 'siswa':
				$res = $this->db->like('tgl_siswa', "$thn", 'after')->order_by('id_siswa', 'DESC')->from('tbl_siswa')->join('tbl_nilai', 'tbl_nilai.no_pendaftaran=tbl_siswa.no_pendaftaran')->get();
				return (object) array(
					'bar'	=> $res->row(),
					'sum'	=> $res->num_rows(),
					'ori'	=> $res
				);
				break;

			case 'materi':
				return $this->db->get_where('tbl_verifikasi', "id_verifikasi='1'")->row();
				break;

			case 'acc':
				switch ($thn) {
					case 'total':
						return $this->db->like('tgl_siswa', "$thn", 'after')->get("tbl_siswa")->num_rows();
						break;

					case 'diverifikasi':
						return $this->db->like('tgl_siswa', "$thn", 'after')->where('status_verifikasi', '1')->get("tbl_siswa")->num_rows();
						break;

					case 'diterima':
						return $this->db->like('tgl_siswa', "$thn", 'after')->where('status_pendaftaran', 'lulus')->get("tbl_siswa")->num_rows();
						break;

					case 'tidak diterima':
						return $this->db->like('tgl_siswa', "$thn", 'after')->where('status_pendaftaran', 'tidak lulus')->get("tbl_siswa")->num_rows();
						break;

					default:
						# code...
						break;
				}
				break;

			default:
				# code...
				break;
		}
	}

	function get_val($menu = '', $id = '')
	{
		switch ($menu) {
			default:
				# code...
				break;
		}
	}

	function update($menu = '', $data = '')
	{
		switch ($menu) {
			case 'teks-verifikasi':
				$this->db->update('tbl_verifikasi', $data, array('id_verifikasi' => "1"));
				break;

			case 'change-stu-verif':
				$param = array(
					'status_verifikasi' => $data['status_verifikasi']
				);
				$this->db->update('tbl_siswa', $param, array('no_pendaftaran' => $data['id']));
				break;

			case 'announce-edited':
				$data = (object) $data;
				$data = array(
					'ket_pengumuman'	=> $data->post('ket_pengumuman')
				);
				$this->db->update('tbl_pengumuman', $data, array('id_pengumuman' => "1"));
				break;

			default:
				# code...
				break;
		}
	}

	function hapus($id) {
		$this->db->delete('tbl_siswa', array('no_pendaftaran' => $id));
	}
}

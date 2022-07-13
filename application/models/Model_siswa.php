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

	function cek_nilai_ujian_seleksi()
	{
		$id_siswa = $this->session->userdata('id_siswa');
		return $this->db
			->query("SELECT u.nama, i.nilai FROM tbl_ujian u LEFT JOIN tbl_ikut_ujian i ON i.id_ujian=u.id_ujian AND i.id_siswa=$id_siswa LIMIT 1");
	}

	function get_tabel_yi($id_siswa)
	{
		$sqrt = [
			'c1' => 0, 'c2' => 0, 'c3' => 0, 'c4' => 0, 'c5' => 0
		];

		foreach ($this->admin->verifikasi('siswa', '')->ori->result() as $row) {
			$temp = [
				'nama' => $row->nama_lengkap,
				'c1' => $row->rata_rata_raport,
				'c2' => $row->rata_rata_usbn,
				'c3' => $row->rata_rata_uas,
				'c4' => $row->nilai_prestasi,
				'c5' => $row->nilai_ujian_seleksi == null ? 0 : $row->nilai_ujian_seleksi
			];
			$alternatif[$row->id_siswa] = $temp;

			$sqrt['c1'] += pow($temp['c1'], 2);
			$sqrt['c2'] += pow($temp['c2'], 2);
			$sqrt['c3'] += pow($temp['c3'], 2);
			$sqrt['c4'] += pow($temp['c4'], 2);
			$sqrt['c5'] += pow($temp['c5'], 2);
		}

		$sqrt['c1'] = number_format(sqrt($sqrt['c1']), 2);
		$sqrt['c2'] = number_format(sqrt($sqrt['c2']), 2);
		$sqrt['c3'] = number_format(sqrt($sqrt['c3']), 2);
		$sqrt['c4'] = number_format(sqrt($sqrt['c4']), 2);
		$sqrt['c5'] = number_format(sqrt($sqrt['c5']), 2);

		foreach ($alternatif as $key => $value) {
			$normalisasi[$key]['c1'] = number_format($value['c1'] / $sqrt['c1'], 2);
			$normalisasi[$key]['c2'] = number_format($value['c2'] / $sqrt['c2'], 2);
			$normalisasi[$key]['c3'] = number_format($value['c3'] / $sqrt['c3'], 2);
			$normalisasi[$key]['c4'] = number_format($value['c4'] / $sqrt['c4'], 2);
			$normalisasi[$key]['c5'] = number_format($value['c5'] / max($sqrt['c5'], 1), 2);
		}

		$kriteria = $this->admin->get_kriteria()->result_array();

		foreach ($normalisasi as $key => $value) {
			$ternormalisasi[$key]['c1'] = number_format($value['c1'] * $kriteria[0]['bobot'], 2);
			$ternormalisasi[$key]['c2'] = number_format($value['c2'] * $kriteria[1]['bobot'], 2);
			$ternormalisasi[$key]['c3'] = number_format($value['c3'] * $kriteria[2]['bobot'], 2);
			$ternormalisasi[$key]['c4'] = number_format($value['c4'] * $kriteria[3]['bobot'], 2);
			$ternormalisasi[$key]['c5'] = number_format($value['c5'] * $kriteria[4]['bobot'], 2);
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

		foreach ($optimasi as $key => $value) {
			$rank[$key]['optimasi'] = $value['yi'];
			$rank[$key]['rank'] = array_search($value['yi'], array_column($tabel_yi, 'optimasi')) + 1;
		}
		return $rank[$id_siswa];
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
			'rata_rata_raport'	=> $this->input->post('rata_rata_raport'),
			'rata_rata_uas'	=> $this->input->post('rata_rata_uas'),
			'rata_rata_usbn'	=> $this->input->post('rata_rata_usbn'),
			'nilai_prestasi'	=> $this->input->post('nilai_prestasi'),
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

	function get_ujian()
	{
		$id_siswa = $this->session->userdata('id_siswa');
		return $this->db
			->query("SELECT u.*, (SELECT COUNT(d.id_daftar_soal_ujian) FROM tbl_daftar_soal_ujian d WHERE d.id_ujian=u.id_ujian) jumlah_soal, i.status FROM tbl_ujian u LEFT JOIN tbl_ikut_ujian i ON i.id_ujian=u.id_ujian AND i.id_siswa=$id_siswa LIMIT 1");
	}

	function cek_ikut_ujian($id_ujian, $id_siswa)
	{
		$ujian["id_ujian"] = $id_ujian;
		$result = $this->db
			->from("tbl_ikut_ujian")
			->where("id_siswa", $id_siswa)
			->where("id_ujian", $id_ujian)
			->get();

		if ($result->num_rows() == 0) {
			$result = $this->db
				->get_where("tbl_ujian", "id_ujian=$id_ujian")
				->row();

			if (time() < strtotime($result->waktu)) {
				$ujian["nama"] = $result->nama;
				$ujian["status"] = "not_available";
				$ujian["waktu"] = $result->waktu;
				return $ujian;
			} else if (time() > strtotime($result->tenggat_waktu)) {
				$ujian["nama"] = $result->nama;
				$ujian["status"] = "missed";
				$ujian["tenggat_waktu"] = $result->tenggat_waktu;
				return $ujian;
			}

			$dt = new DateTimeImmutable();
			$waktu_mulai = $dt->format('Y-m-d H:i:s');
			$waktu_selesai = $dt->modify("+$result->durasi minutes")->format('Y-m-d H:i:s');

			$this->db->insert("tbl_ikut_ujian", array(
				"id_ujian" => $id_ujian,
				"id_siswa" => $id_siswa,
				"waktu_mulai" => $waktu_mulai,
				"waktu_selesai" => $waktu_selesai,
				"status" => "progress"
			));

			$ujian["nama"] = $result->nama;
			$ujian["status"] = "progress";
			$ujian["waktu_selesai"] = $waktu_selesai;
			$ujian["daftar_soal"] = $this->get_daftar_soal_ujian($id_ujian, $id_siswa);
		} else {
			$this->cek_status_ujian();
			$result = $this->db->get_where("tbl_ikut_ujian", "id_ujian=$id_ujian AND id_siswa=$id_siswa")->result()[0];
			$ujian["nama"] = $this->db
				->get_where("tbl_ujian", "id_ujian=$id_ujian")
				->row()->nama;
			$ujian["status"] = $result->status;
			if ($result->status == "completed") {
				$ujian["nilai"] = $result->nilai;
			} else {
				$ujian["waktu_selesai"] = $result->waktu_selesai;
				$ujian["daftar_soal"] = $this->get_daftar_soal_ujian($id_ujian, $id_siswa);
			}
		}
		return $ujian;
	}

	function get_daftar_soal_ujian($id_ujian, $id_siswa)
	{
		$this->db->select("s.id_soal, s.soal, s.media, s.opsi_a, s.opsi_b, s.opsi_c, s.opsi_d, s.opsi_e");
		$this->db->from("tbl_daftar_soal_ujian d");
		$this->db->join("tbl_soal s", "s.id_soal=d.id_soal");
		$this->db->join("tbl_ikut_ujian i", "i.id_ujian=d.id_ujian");
		$this->db->where(array(
			"d.id_ujian" => $id_ujian,
			"i.id_siswa" => $id_siswa
		));
		return json_encode($this->db->get()->result_array());
	}

	function akhiri_ujian($id_ujian, $id_siswa)
	{
		$waktu_selesai = (new DateTime())->format('Y-m-d H:i:s');
		$id_ikut_ujian = $this->db->get_where("tbl_ikut_ujian", "id_ujian=$id_ujian AND id_siswa=$id_siswa")->result()[0]->id_ikut_ujian;
		$jumlah_soal = $this->db
			->select("COUNT(*) jumlah_soal")
			->get_where("tbl_daftar_soal_ujian", "id_ujian=$id_ujian")
			->result()[0]
			->jumlah_soal;
		$jumlah_soal_benar = $this->db
			->select("COUNT(*) jumlah_soal_benar")
			->from("tbl_jawaban_ujian_siswa j")
			->join("tbl_soal s", "s.id_soal=j.id_soal")
			->where("j.id_ikut_ujian=$id_ikut_ujian AND j.jawaban=s.jawaban")
			->get()
			->result()[0]
			->jumlah_soal_benar;
		$nilai = ($jumlah_soal_benar / $jumlah_soal) * 100;

		$this->db
			->set("waktu_selesai", $waktu_selesai)
			->set("nilai", $nilai)
			->set("status", "completed")
			->where("id_ikut_ujian=$id_ikut_ujian")
			->update("tbl_ikut_ujian");
	}

	function cek_total_jawaban_ujian($id_ujian) {
		$id_siswa = $this->session->userdata('id_siswa');
		$id_ikut_ujian = $this->db->get_where("tbl_ikut_ujian", "id_ujian=$id_ujian AND id_siswa=$id_siswa")->result()[0]->id_ikut_ujian;
		$jumlah_soal = $this->db
			->select("COUNT(*) jumlah_soal")
			->get_where("tbl_daftar_soal_ujian", "id_ujian=$id_ujian")
			->result()[0]
			->jumlah_soal;
		$jumlah_soal_terjawab = $this->db
			->select("COUNT(*) jumlah_soal_terjawab")
			->from("tbl_jawaban_ujian_siswa j")
			->join("tbl_soal s", "s.id_soal=j.id_soal")
			->where("j.id_ikut_ujian=$id_ikut_ujian")
			->get()
			->result()[0]
			->jumlah_soal_terjawab;
		$result = array(
			"akhiriUjian" => $jumlah_soal == $jumlah_soal_terjawab
		);
		return json_encode($result);
	}

	function cek_status_ujian()
	{
		$query = $this->db->get_where("tbl_ikut_ujian", "waktu_selesai < NOW() AND status='progress'");

		foreach ($query->result() as $row) {
			$jumlah_soal = $this->db
				->select("COUNT(*) jumlah_soal")
				->get_where("tbl_daftar_soal_ujian", "id_ujian=$row->id_ujian")
				->result()[0]
				->jumlah_soal;
			$jumlah_soal_benar = $this->db
				->select("COUNT(*) jumlah_soal_benar")
				->from("tbl_jawaban_ujian_siswa j")
				->join("tbl_soal s", "s.id_soal=j.id_soal")
				->where("j.id_ikut_ujian=$row->id_ikut_ujian AND j.jawaban=s.jawaban")
				->get()
				->result()[0]
				->jumlah_soal_benar;
			$nilai = ($jumlah_soal_benar / $jumlah_soal) * 100;

			$this->db
				->set("nilai", $nilai)
				->set("status", "completed")
				->where("id_ikut_ujian", $row->id_ikut_ujian)
				->update("tbl_ikut_ujian");
		}
	}

	function jumlah_soal_ujian($id_ujian) {
		return $this->db
			->from("tbl_daftar_soal_ujian")
			->where("id_ujian", $id_ujian)
			->count_all_results();
	}

	function simpan_jawaban_soal($id_ujian, $id_soal, $jawaban) {
		$id_siswa = $this->session->userdata('id_siswa');
		$id_ikut_ujian = $this->db
			->get_where("tbl_ikut_ujian", "id_ujian=$id_ujian AND id_siswa=$id_siswa")
			->row()
			->id_ikut_ujian;
		$result = $this->db
			->get_where("tbl_jawaban_ujian_siswa", "id_ikut_ujian=$id_ikut_ujian AND id_soal=$id_soal");
			
		if ($result->num_rows() == 0) {
			$this->db->insert("tbl_jawaban_ujian_siswa", array(
				"id_ikut_ujian" => $id_ikut_ujian,
				"id_soal" => $id_soal,
				"jawaban" => $jawaban
			));
		} else {
			$this->db
				->set("jawaban", $jawaban)
				->where("id_ikut_ujian=$id_ikut_ujian AND id_soal=$id_soal")
				->update("tbl_jawaban_ujian_siswa");
		}
	}

	function get_jawaban_soal($id_ujian, $id_soal) {
		$id_siswa = $this->session->userdata('id_siswa');
		$id_ikut_ujian = $this->db
			->get_where("tbl_ikut_ujian", "id_ujian=$id_ujian AND id_siswa=$id_siswa")
			->row()
			->id_ikut_ujian;
		$result = $this->db
			->get_where("tbl_jawaban_ujian_siswa", "id_ikut_ujian=$id_ikut_ujian AND id_soal=$id_soal");
		if ($result->num_rows() > 0) {
			$res["jawaban"] = $result->row()->jawaban;
		} else {
			$res["jawaban"] = null;
		}
		return json_encode($res);
	}

	function get_data()
	{
		return json_encode($this->db->get_where('tbl_siswa', "no_pendaftaran='" . $this->session->userdata('no_pendaftaran') . "'")->row());
	}

	function get_detail_ujian($id_ujian) {
		return $this->db->get_where('tbl_ujian', "id_ujian='$id_ujian'")->row();
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

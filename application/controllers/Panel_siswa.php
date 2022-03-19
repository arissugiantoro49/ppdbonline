<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Panel_siswa extends CI_Controller
{

	public function index()
	{
		if ($this->session->userdata('no_pendaftaran') == NULL) {
			redirect('');
		} else {
			$data = array(
				'user'		=> $this->siswa->base_biodata($this->session->userdata('no_pendaftaran')),
				'judul_web'	=> "HOME"
			);

			$this->load->view('siswa/header', $data);
			$this->load->view('siswa/dashboard', $data);
			$this->load->view('siswa/footer');
		}
	}

	public function pengumuman()
	{
		if ($this->session->userdata('no_pendaftaran') == NULL) {
			redirect('');
		} else {
			$data = array(
				'user'		=> $this->siswa->base_biodata($this->session->userdata('no_pendaftaran')),
				'judul_web'	=> "PENGUMUMAN"
			);

			$this->load->view('siswa/header', $data);
			$this->load->view('siswa/pengumuman', $data);
			$this->load->view('siswa/footer');
		}
	}

	public function biodata()
	{
		if ($this->session->userdata('no_pendaftaran') == NULL) {
			redirect('logcs');
		} else {
			$sess = $this->session->userdata('no_pendaftaran');
			$data = array(
				'user'		=> $this->siswa->base_biodata($sess),
				'judul_web'	=> "BIODATA"
			);

			$this->load->view('siswa/header', $data);
			$this->load->view('siswa/biodata', $data);
			$this->load->view('siswa/footer');
		}
	}

	public function dataku() {
		echo $this->siswa->get_data();
	}

	public function data_nilai() {
		echo $this->siswa->get_nilai();
	}

	public function ubah_biodata() {
		if ($this->session->userdata('no_pendaftaran') == NULL) {
			redirect('logcs');
		} else {
			$this->siswa->ubah_biodata();
			redirect('panel_siswa/biodata?edit=success');
		}
	}

	public function ubah_nilai() {
		if ($this->session->userdata('no_pendaftaran') == NULL) {
			redirect('logcs');
		} else {
			$this->siswa->ubah_nilai();
			redirect('panel_siswa/rekap_nilai?edit=success');
		}
	}

	public function download_dokumen() {
		$data = json_decode($this->siswa->get_data());
		$id = $data->no_pendaftaran;
		if (empty($data->dokumen_kk) &&
			empty($data->dokumen_akte_kelahiran) &&
			empty($data->dokumen_skl) &&
			empty($data->dokumen_kartu_bantuan)
		) {
			echo "<h3>Dokumen kosong</h3>";
			return;
		}

		$dir = "./uploads/dokumen/";
		$zip = new ZipArchive();
		$zip->open($dir . $id . ".zip", ZipArchive::CREATE | ZipArchive::OVERWRITE);

		if (!empty($data->dokumen_kk)) 
			$zip->addFile($dir . $data->dokumen_kk, "kk." . pathinfo($data->dokumen_kk, PATHINFO_EXTENSION));
		if (!empty($data->dokumen_akte_kelahiran)) 
			$zip->addFile($dir . $data->dokumen_akte_kelahiran, "akte_kelahiran." . pathinfo($data->dokumen_akte_kelahiran, PATHINFO_EXTENSION));
		if (!empty($data->dokumen_skl)) 
			$zip->addFile($dir . $data->dokumen_skl, "skl." . pathinfo($data->dokumen_skl, PATHINFO_EXTENSION));
		if (!empty($data->dokumen_kartu_bantuan)) 
			$zip->addFile($dir . $data->dokumen_kartu_bantuan, "kartu_bantuan." . pathinfo($data->dokumen_kartu_bantuan, PATHINFO_EXTENSION));

		$zip->close();
		
		header("Content-type: application/zip");
		header("Content-Disposition: attachment; filename=" . $id . ".zip");
		header("Pragma: no-cache");
		header("Expires: 0");
		readfile($dir . $id . ".zip");
	}


	public function cetak()
	{
		if ($this->session->userdata('no_pendaftaran') == NULL) {
			redirect('logcs');
		}
		$sess 		= $this->session->userdata('no_pendaftaran');
		$base_bio 	= $this->siswa->base_biodata($sess);
		$data = array(
			'user'			=> $base_bio,
			'judul_web'		=> ucwords($base_bio->no_pendaftaran) . '-' . ucwords($base_bio->nama_lengkap),
			'thn_ppdb'		=> date('Y', strtotime($base_bio->tgl_siswa))
		);

		$this->load->view('siswa/cetak', $data);
	}


	public function rekap_nilai()
	{
		if ($this->session->userdata('no_pendaftaran') == NULL) {
			redirect('logcs');
		} else {
			$sess = $this->session->userdata('no_pendaftaran');
			$data = array(
				'user'		=> $this->siswa->base_biodata($sess),
				'nilai'		=> $this->siswa->cek_nilai($sess),
				'judul_web'	=> "BIODATA"
			);

			$this->load->view('siswa/header', $data);
			$this->load->view('siswa/rekap_nilai', $data);
			$this->load->view('siswa/footer');
		}
	}

	public function cetak_lulus()
	{
		if ($this->session->userdata('no_pendaftaran') == NULL) {
			redirect('logcs');
		}

		$sess 		= $this->session->userdata('no_pendaftaran');
		$base_bio 	= $this->siswa->base_biodata($sess);

		$data = array(
			'user'		=> $this->siswa->get_print('passed', $sess),
			'judul_web'	=> "Cetak Bukti Lulus " . ucwords($base_bio->nama_lengkap),
			'thn_ppdb'	=> date('Y', strtotime($base_bio->tgl_siswa)),
			'v_ket'		=> $this->siswa->get_print('announcement')
		);

		if ($data['user']->status_pendaftaran != 'lulus') {
			redirect('404');
		}

		$this->load->view('siswa/cetak_lulus', $data);
	}

	public function logout()
	{
		if ($this->session->userdata('no_pendaftaran') != '') {
			$this->session->sess_destroy();
		}
		redirect('');
	}
}

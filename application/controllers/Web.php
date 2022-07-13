<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Web extends CI_Controller
{

	public function index()
	{
		$data['web_ppdb']	 = $this->web->web_utama();
		
		 $thn =date('Y'); 
		$data['lst']	 =$this->admin->verifikasi('siswa', $thn)->ori->result();
		$this->load->view('web/index', $data);
	}

	public function idbaru($value = '')
	{
		echo $this->web->pendaftaran('id_baru');
	}

	public function pendaftaran()
	{
		$data = array(
			'id_daftar'			=> $this->web->pendaftaran('id_baru'),
			'web_ppdb'			=> $this->web->pendaftaran('status_ppdb'),
			'v_pdd'				=> $this->web->pendaftaran('v_pdd'),
			'v_penghasilan'		=> $this->web->pendaftaran('v_penghasilan'),
			'v_pekerjaan_ayah'	=> $this->web->pendaftaran('v_pekerjaan_ayah'),
			'v_komp'			=> $this->web->pendaftaran('v_komp'),
			'v_pekerjaan_ibu'	=> $this->web->pendaftaran('v_pekerjaan_ibu'),
			'v_pekerjaan_wali'	=> $this->web->pendaftaran('v_pekerjaan_wali')
		);

		if ($data['web_ppdb']->status_ppdb == 'tutup') {
			redirect('404');
		}

		$this->load->view('web/pendaftaran', $data);

		if (isset($_POST['btndaftar'])) {
			$id = $this->web->pendaftaran('daftar', $this->input);
			$this->session->set_userdata('no_pendaftaran', $this->input->post('nis'));
			$this->session->set_userdata('id_siswa', $id);
			redirect('panel_siswa');
		}
	}

	public function logcs()
	{
		$data['web_ppdb']	 = $this->web->pendaftaran('status_ppdb');
		if ($data['web_ppdb']->status_ppdb == 'tutup') {
			redirect('404');
		}

		if ($this->session->userdata('no_pendaftaran') != NULL) {
			redirect('panel_siswa');
		} else {
			$thn =date('Y'); 
			$data['lst']	 =$this->admin->verifikasi('siswa', $thn)->ori->result();
			$this->load->view('web/index', $data);

			if (isset($_POST['btnlogin'])) {
				$send = array(
					'no_pendaftaran' => $this->input->post('username'),
					'password' => $this->input->post('password')
				);
				$auth = $this->web->auth('cek-masuk', $send);

				if ($auth['sum'] == 0) {
					$this->session->set_flashdata('msg', $auth['sum']);
					redirect('logcs');
				} else {
					$this->session->set_userdata('no_pendaftaran', $auth['res']->no_pendaftaran);
					$this->session->set_userdata('id_siswa', $auth['res']->id_siswa);
					redirect('panel_siswa');
				}
			}
		}
	}

	public function cari()
	{
		$data['siswa'] = $this->SiswaModel->view();
		$this->load->view('web/cari', $data);
	}

		public function ubah_siswa($aksi = '', $id = '')
	{
		$sess = $this->session->userdata('id_admin');

		if ($sess == NULL) {
			redirect('panel_admin/log_in');
		} else {

			switch ($aksi) {

				case 'thn':
					$thn = $id;
					break;
				case 'hapus1':
					$this->admin->hapus($id);
					redirect('panel_admin/siswa');
					break;
				default:
					$thn = date('Y');
					break;
			}

			$data = array(
				'user' 		=> $this->admin->base('bio', $this->session->userdata('id_admin')),
				'judul_web'	=> "DATA SISWA",
				'v_siswa'	=> $this->admin->verifikasi('siswa', $thn)->ori,
				'v_thn'		=> $thn
			);

			$this->load->view('admin/header', $data);
			$this->load->view('admin/edit', $data);
			$this->load->view('admin/footer');
			

			if (isset($_POST['btnupdate'])) {

				$data = array(
					'old_user'				=> $this->session->userdata('id_siswa'),
					'no_pendaftaran'		=> $this->session->userdata('no_pendaftaran'),
					'nisn'					=> $this->session->userdata('nisn'),
					'nik'					=> $this->session->userdata('nik'),
					'nama_lengkap'			=> $this->session->userdata('nama_lengkap'),
					'jk'					=> $this->session->userdata('jk'),
					'tempat_lahir'			=> $this->session->userdata('tempat_lahir'),
					'tgl_lahir'				=> $this->session->userdata('tgl_lahir'),
					'agama'					=> $this->session->userdata('agama'),
					'status_keluarga'		=> $this->session->userdata('status_keluarga'),
					'anak_ke'				=> $this->session->userdata('anak_ke'),
					'jml_saudara'			=> $this->session->userdata('jml_saudara'),
					'hobi'					=> $this->session->userdata('hobi'),
					'cita'					=> $this->session->userdata('cita'),
					'paud'					=> $this->session->userdata('paud'),
					'tk'					=> $this->session->userdata('tk'),
					'no_hp_siswa'			=> $this->session->userdata('no_hp_siswa'),
					'jenis_tinggal'			=> $this->session->userdata('jenis_tinggal'),
					'alamat_siswa'			=> $this->session->userdata('alamat_siswa'),
					'desa'					=> $this->session->userdata('desa'),
					'kec'					=> $this->session->userdata('kec'),
					'kab'					=> $this->session->userdata('kab'),
					'prov'					=> $this->session->userdata('prov'),
					'kode_pos'				=> $this->session->userdata('kode_pos'),
					'jarak'					=> $this->session->userdata('jarak'),
					'trans'					=> $this->session->userdata('trans'),
					'no_kk'					=> $this->session->userdata('no_kk'),
					'kepala_keluarga'		=> $this->session->userdata('kepala_keluarga'),
					'nama_ayah'				=> $this->session->userdata('nama_ayah'),
					'th_lahir_ayah'			=> $this->session->userdata('th_lahir_ayah'),
					'status_ayah'			=> $this->session->userdata('status_ayah'),
					'nik_ayah'				=> $this->session->userdata('nik_ayah'),
					'pdd_ayah'				=> $this->session->userdata('pdd_ayah'),
					'pekerjaan_ayah'		=> $this->session->userdata('pekerjaan_ayah'),
					'nama_ibu'				=> $this->session->userdata('nama_ibu'),
					'th_lahir_ibu'			=> $this->session->userdata('th_lahir_ibu'),
					'status_ibu'			=> $this->session->userdata('status_ibu'),
					'nik_ibu'				=> $this->session->userdata('nik_ibu'),
					'pdd_ibu'				=> $this->session->userdata('pdd_ibu'),
					'pekerjaan_ibu'			=> $this->session->userdata('pekerjaan_ibu'),
					'nama_wali'				=> $this->session->userdata('nama_wali'),
					'th_lahir_wali'			=> $this->session->userdata('th_lahir_wali'),
					'nik_wali'				=> $this->session->userdata('nik_wali'),
					'pdd_wali'				=> $this->session->userdata('pdd_wali'),
					'pekerjaan_wali'		=> $this->session->userdata('pekerjaan_wali'),
					'penghasilan_ayah'		=> $this->session->userdata('penghasilan_ayah'),
					'penghasilan_ibu'		=> $this->session->userdata('penghasilan_ibu'),
					'penghasilan_wali'		=> $this->session->userdata('penghasilan_wali'),
					'no_kks'				=> $this->session->userdata('no_kks'),
					'no_pkh'				=> $this->session->userdata('no_pkh'),
					'no_kip'				=> $this->session->userdata('no_kip'),
					'no_hp_ortu'			=> $this->session->userdata('no_hp_ortu'),
					'nama_sekolah'			=> $this->session->userdata('nama_sekolah'),
					'jenjang_sekolah'		=> $this->session->userdata('jenjang_sekolah'),
					'status_sekolah'		=> $this->session->userdata('status_sekolah'),
					'npsn_sekolah'			=> $this->session->userdata('npsn_sekolah'),
					'lokasi_sekolah'		=> $this->session->userdata('lokasi_sekolah'),
					'komp_ahli'				=> $this->session->userdata('komp_ahli')

				);

				$acts = $this->admin->edit_siswa('update', $data);
				$this->session->has_userdata('id_siswa');
				$this->session->set_userdata('id_siswa', $data['no_pendaftaran']);
				$this->session->set_flashdata('msg', $this->err->update_admin('no_pendaftaran'));
				redirect('panel_admin/profile');
			}
		}
	}


	function error_not_found()
	{
		$this->load->view('404_content');
	}
}

<?php


function bulan($no)
{
	switch ($no) {
		case 1:
			return 'Januari';
			break;
		case 2:
			return 'Februari';
			break;
		case 3:
			return 'Maret';
			break;
		case 4:
			return 'April';
			break;
		case 5:
			return 'Mei';
			break;
		case 6:
			return 'Juni';
			break;
		case 7:
			return 'Juli';
			break;
		case 8:
			return 'Agustus';
			break;
		case 9:
			return 'September';
			break;
		case 10:
			return 'Oktober';
			break;
		case 11:
			return 'November';
			break;
		case 12:
			return 'Desember';
			break;
	}
}

function data_bulan()
{
	return [
		[
			'no' => 1,
			'nama' => 'Januari'
		],
		[
			'no' => 2,
			'nama' => 'Februari'
		],
		[
			'no' => 3,
			'nama' => 'Maret'
		],
		[
			'no' => 4,
			'nama' => 'April'
		],
		[
			'no' => 5,
			'nama' => 'Mei'
		],
		[
			'no' => 6,
			'nama' => 'Juni'
		],
		[
			'no' => 7,
			'nama' => 'Juli'
		],
		[
			'no' => 8,
			'nama' => 'Agustus'
		],
		[
			'no' => 9,
			'nama' => 'September'
		],
		[
			'no' => 10,
			'nama' => 'Oktober'
		],
		[
			'no' => 11,
			'nama' => 'November'
		],
		[
			'no' => 12,
			'nama' => 'Desember'
		],
	];
}


function cekPembayaran($id_siswa,$id_pembayaran_tahun_pelajaran)
{
	$ci = get_instance();
	$ci->load->model('M_pembayaran','pembayaran');
	$dp = $ci->pembayaran->find(array('pmb.id_siswa' => $id_siswa,'pmb.id_pembayaran_tahun_pelajaran' => $id_pembayaran_tahun_pelajaran))->row();
	if($dp)
	{
		if($dp->status == 1)
		{
			echo 'Lunas';
		}elseif($dp->status == 2)
		{
			echo 'Belum Bayar';
		}else{
			echo 'Dalam Proses';
		}
	}else{
		echo 'Belum Bayar';
	}

}
function cekPembayaran2($id_siswa,$id_pembayaran_tahun_pelajaran)
{
	$ci = get_instance();
	$ci->load->model('M_pembayaran','pembayaran');
	$dp = $ci->pembayaran->find(array('pmb.id_siswa' => $id_siswa,'pmb.id_pembayaran_tahun_pelajaran' => $id_pembayaran_tahun_pelajaran))->row();
	if(!$dp)
	{
		return false;
	}

}

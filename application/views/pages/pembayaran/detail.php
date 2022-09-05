<table class="table table-bordered">
	<tbody>
		<thead>
			<th class="align-middle" style="width: 10px;">No.</th>
			<th class="align-middle">Tanggal</th>
			<th class="align-middle">Tahun Pelajaran</th>
			<th class="align-middle">Bulan</th>
			<th class="align-middle">DBOTS (RP)</th>
			<th class="align-middle">AKSI</th>
		</thead>
	<tbody>
		<?php

		use Carbon\Carbon;

		$i = 1; ?>
		<?php foreach ($pembayaran as $pem) : ?>
			<tr>
				<td class="text-center"><?= $i++; ?></td>
				<td><?= Carbon::parse($pem->tanggal_pembayaran)->translatedFormat('d/m/Y') ?></td>
				<td><?= $pem->tahun_pelajaran ?></td>
				<td><?= bulan($pem->bulan) ?></td>
				<td>Rp. <?= number_format($pem->nominal) ?></td>
				<td>
					<?php if ($pem->status == 1) : ?>
						<span class="badge badge-success">Lunas</span>
					<?php elseif ($pem->status == 2) : ?>
						<span class="badge badge-danger">Belum</span>
					<?php else : ?>
						<span class="badge badge-warning">Dalam Proses</span>
					<?php endif; ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
	</tbody>
</table>

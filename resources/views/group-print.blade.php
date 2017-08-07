<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Print Group</title>
	<style>
		table {
		    border-collapse: collapse;
		}

		table, th, td {
			padding: 5px;
			text-align: center;
		    border: 1px solid black;
		}
	</style>
</head>
<body>
	

	<div style="width: 100%">
		<div style="margin-right: auto;margin-left: auto;">
			<h4 align="center">DAFTAR GRUP PAGAR NUSA</h4>
			<h4 align="center">KABUPATEN KLATEN</h4>
		</div>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>

		<table border="1" style="margin-right: auto;margin-left: auto;">
			<thead>
				<tr>
					<th>Nama Grup</th>
					<th>Ketua Grup</th>
					<th>Kecamatan</th>
					<th>Alamat</th>
					<th>Jml Anggota</th>
					<th>Dibentuk</th>
				</tr>
			</thead>
			<tbody>
				@foreach($groups as $group)
				<tr>
					<td>{{ $group->nama_grup }}</td>
					<td>{{ $group->user->name }}</td>
					<td>{{ $group->location->kecamatan->name }}</td>
					<td>{{ $group->location->alamat }}</td>
					<td>{{ count($group->anggota) }}</td>
					<td>{{ date_format($group->created_at, 'Y-m-d') }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	
</body>
</html>
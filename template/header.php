<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Halaman Admin</title>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Pacifico&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/stylehome.css">
	
	
</head>
<body>
	<header>
		<div class="menu-toggle">
            <input type="checkbox" onclick="menuToggle()">
            <span></span>
            <span></span>
            <span></span>
        </div>
		<div class="logo">
			<h4>
				Aplikasi Manajemen Perpustakaan
			</h4>
		</div>
		<a href="logout.php" class="logout">Logout</a>
	</header>
	<aside>
		<ul>
			<li><a href="index.php">Dashboard</a></li>
			<Span></Span>
			<!-- <Span></Span> -->
			<li><a href="buku.php">Buku</a></li>
			<!-- <Span></Span> -->
			<li><a href="anggota.php">Anggota</a></li>
			<!-- <Span></Span> -->
			<li><a href="peminjaman.php">Peminjaman</a></li>
			<Span></Span>
			<!-- <span></span> -->
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</aside>
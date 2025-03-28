<?php
	include "_Config/Connection.php";
	include "_Config/GlobalFunction.php";
	include "_Config/Setting.php";
	date_default_timezone_set('Asia/Jakarta');
	if(!empty($_GET['id'])){
		$id=$_GET['id'];
		$id=validateAndSanitizeInput($id);
		//id hanya boleh angka dan huruf
		if (!preg_match('/^[a-zA-Z0-9]+$/', $id)) {
			$id = ""; // Mengosongkan $id jika tidak valid
			$NamaUndangan = ""; // Mengosongkan $NamaUndangan jika tidak valid
		}else{
			$NamaUndangan=GetDetailData($Conn,'kontak','uid_kontak',$id,'nama');
		}
	}else{
		$id="";
		$NamaUndangan = "";
	}
	//rekam pengunjung
	$datetime_visited = date('Y-m-d H:i:s');
	// Cek koneksi
	if ($Conn->connect_error) {
		die("Connection failed: " . $Conn->connect_error);
	}
	// Insert data kunjungan ke tabel visitors
	$query = "INSERT INTO visitors (datetime_visited) VALUES (?)";
	$stmt = $Conn->prepare($query);
	if (!$stmt) {
		die("Prepare failed: " . $Conn->error); // Menampilkan error jika prepare gagal
	}
	$stmt->bind_param("s", $datetime_visited);
	if ($stmt->execute()) {
		
	} else {
		echo "Gagal merekam kunjungan: " . $stmt->error;
	}
	$stmt->close();
	//Jumlah Pengunjung
	$query = "SELECT COUNT(*) as total_visitors FROM visitors";
	$result = $Conn->query($query);
	$row = $result->fetch_assoc();
	$total_visitors = $row['total_visitors'];
	//Menghitung data kontak
	$JumlahKontak = mysqli_num_rows(mysqli_query($Conn, "SELECT id_kontak FROM kontak"));
	//Menghitung Jumlah attender
	$JumlahAttender = mysqli_num_rows(mysqli_query($Conn, "SELECT id_attended FROM attended"));
	//Menampilkan Testimonial
	$testimoni = [];
	$query = "SELECT nama, pesan, datetime FROM testimoni WHERE status = 'Publish' ORDER BY datetime DESC";
	$result = $Conn->query($query);

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$testimoni[] = $row;
		}
	}
?>
<!DOCTYPE html>
<html class="no-js">
	<?php
		// Partial Page
		include "_Partial/Head.php";
	?>
	<body>
		<div class="fh5co-loader"></div>
		<div id="page">
			<nav class="fh5co-nav" role="navigation">
				<div class="container">
					<div class="row">
						<div class="col-xs-2">
							<!-- <div id="fh5co-logo">
								<a href="">Wedding<strong>.</strong></a>
							</div> -->
						</div>
						<div class="col-xs-10 text-right menu-1">
							<ul>
								<li class="active">
									<a href=""><i class="icon icon-home"></i> Home</a>
								</li>
								<li class="active">
									<a href="https://www.instagram.com/adi.fsetiadi/">
										<i class="icon icon-instagram"></i> Adi
									</a>
								</li>
								<li class="active">
									<a href="https://www.instagram.com/taritar15">
										<i class="icon icon-instagram"></i> Tari
									</a>
								</li>
								<li class="active">
									<a href="https://maps.app.goo.gl/XfSrLby4LqwniEHo9">
										<i class="icon icon-map2"></i> Lokasi
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</nav>
			<header id="fh5co-header" class="fh5co-cover" role="banner" style="background-image:url(<?php echo "$base_url"; ?>/assets/img/konten/page_1.png);" data-stellar-background-ratio="0.5">
				<div class="overlay"></div>
				<!--<div class="snowflakes"></div> -->
				<!-- Kontainer untuk salju -->
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2 text-center">
							<div class="display-t">
								<div class="display-tc animate-box" data-animate-effect="fadeIn">
									<h1><?php echo "$title_page_1"; ?></h1>
									<h2><?php echo "$subtitle_page_1"; ?></h2>
									<div class="simply-countdown simply-countdown-one"></div>
									<div id="my-countdown"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>
			<div id="fh5co-services" class="fh5co-section-gray">
				<div class="container">
					<div class="row">
						<div class="col-md-12 animate-box">
							<div class="fh5co-video fh5co-bg">
								<video width="100%" controls autoplay muted loop>
									<source src="<?php echo "$base_url"; ?>/assets/img/konten/vidio.mp4" type="video/mp4">
									Your browser does not support the video tag.
								</video>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="fh5co-couple">
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box">
							<h2>Assalamualaikum Wr Wb</h2>
							<?php
								//Apabila ID Undangan ada
								if(!empty($NamaUndangan)){
									echo '<h3>Yth. '.$NamaUndangan.'</h3>';
								}
							?>
							<p>Dengan penuh rasa syukur dan kebahagiaan, kami mengundang Anda untuk hadir pada acara pernikahan kami </p>
						</div>
					</div>
					<div class="couple-wrap animate-box">
						<div class="couple-half">
							<div class="groom">
								<img src="<?php echo "$base_url"; ?>/assets/img/konten/male.png" alt="groom" class="img-responsive">
							</div>
							<div class="desc-groom">
								<h3>Adi Fuji Stiadi</h3>
								<p>
									Putra Dari :<br>
									<small>
										<i>Bapak Entang Mahfud (Alm)</i>
									</small>
									<br>
									<small>
										<i>Ibu Sukmawati (Alm)</i>
									</small>
								</p>
							</div>
						</div>
						<p class="heart text-center"><i class="icon-heart2"></i></p>
						<div class="couple-half">
							<div class="bride">
								<img src="<?php echo "$base_url"; ?>/assets/img/konten/female.png" alt="groom" class="img-responsive">
							</div>
							<div class="desc-bride">
								<h3>Siti Lestari</h3>
								<p>
									Putri Dari :<br>
									<small>
										<i>Bapak Suwarno</i>
									</small>
									<br>
									<small>
										<i>Ibu Tarsih</i>
									</small>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="fh5co-event" class="fh5co-bg" style="background-image:url(<?php echo "$base_url"; ?>/assets/img/konten/<?php echo "$background_page3"; ?>);">
				<div class="overlay"></div>
				<div class="container">
					<div class="row">
						<div class="display-t">
							<div class="display-tc">
								<div class="col-md-12">
									<div class="col-md-3 col-sm-4 text-center">
										<div class="event-wrap animate-box">
											<h3>Hari, Tanggal</h3>
											<div class="event-col-12">
												<i class="icon-calendar"></i>
												<span>Minggu, 29/09/2024</span>
											</div>
										</div>
									</div>
									<div class="col-md-3 col-sm-4 text-center">
										<div class="event-wrap animate-box">
											<h3>Jam</h3>
											<div class="event-col-12">
												<i class="icon-clock"></i>
												<span>07.30 s/d 11.00 WIB</span>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12 text-center">
										<div class="event-wrap animate-box">
											<h3>Tempat/Lokasi</h3>
											<div class="event-col-12">
												<i class="icon-map"></i>
												<span>Mayang Catering - Kebon Kaisar (Jl. RE. Martadinata No.176, Ciporang Kuningan)</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="fh5co-couple">
				<div class="container">
					<p><br></p>
					<div class="row">
						<div class="col-md-12 text-center fh5co-heading animate-box quran-quote">
							<div class="quran-verse">
								<h3 class="animate-verse">وَمِنْ آيَاتِهِ أَنْ خَلَقَ لَكُمْ مِنْ أَنفُسِكُمْ أَزْوَاجًا لِّيَسْكُنُوا إِلَيْهَا وَجَعَلَ بَيْنَكُمْ مَوَدَّةً وَرَحْمَةً إِنَّ فِي ذَٰلِكَ لَآيَاتٍ لِّقَوْمٍ يَتَفَكَّرُونَ</h3>
								<em class="animate-verse">"Dari tanda-tanda (kebesaran-Nya) ialah bahwa Dia menciptakan untukmu pasangan-pasangan dari jenismu sendiri supaya kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antara kamu rasa kasih dan sayang. Sesungguhnya dalam hal ini benar-benar terdapat tanda-tanda bagi kaum yang berpikir."<br>(QS. Ar-Rum: 21)</em>
							</div>
							<div class="quran-verse">
								<h3 class="animate-verse">وَأَنْكِحُوا الْأَيَامَىٰ مِنْكُمْ وَالصَّالِحِينَ مِنْ عِبَادِكُمْ وَإِمَائِكُمْ ۗ إِن يَكُونُوا فُقَرَاءَ يُغْنِهِمُ اللَّهُ مِنْ فَضْلِهِ ۗ وَاللَّهُ وَاسِعٌ عَلِيمٌ</h3>
								<em class="animate-verse">"Nikahkanlah orang-orang yang sendirian di antara kamu dan orang-orang yang layak (menikah) dari hamba-hamba sahaya kamu dan budak-budak kamu. Jika mereka miskin, Allah akan memberi kekayaan kepada mereka dari karunia-Nya. Dan Allah Maha Luas lagi Maha Mengetahui."<br>(QS. An-Nur: 32)</em>
							</div>
							<div class="quran-verse">
								<h3 class="animate-verse">وَمِن كُلِّ شَيْءٍ خَلَقْنَا زَوْجَيْنِ لَّعَلَّكُمْ تَذَكَّرُونَ</h3>
								<em class="animate-verse">"Dan dari segala sesuatu Kami ciptakan berpasang-pasangan supaya kamu mengingat (kebesaran Allah)."<br>(QS. Az-Zariyat: 49)</em>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="fh5co-started" class="fh5co-bg" style="background-image:url(<?php echo "$base_url"; ?>/assets/img/konten/testimoni_bg.png);">
				<div class="overlay"></div>
				<div class="container">
					<div class="row animate-box">
						<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
							<h2>Kirim Ucapan</h2>
							<p><i>Kirim ucapan kepada pengantin</i></p>
						</div>
					</div>
					<div class="row animate-box">
						<div class="col-md-12 col-md-offset-1">
							<form action="javascript:void(0);" class="form-inline" id="ProsesKirimUcapan">
								<div class="col-md-12 mb-3">
									<div class="form-group">
										<label for="nama_pengirim" class="sr-only">Nama</label>
										<input type="text" class="form-control" id="nama_pengirim" name="nama_pengirim" placeholder="Nama">
									</div>
								</div>
								<div class="col-md-12 mb-3">
									<div class="form-group">
										<label for="pesan" class="sr-only">Isi Pesan</label>
										<textarea name="pesan" id="pesan" class="form-control" placeholder="Isi Pesan"></textarea>
									</div>
								</div>
								<div class="col-md-12 mb-3">
									<button type="submit" class="btn btn-default btn-block" id="TombolKirimUcapan">Kirim</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div id="fh5co-testimonial" class="testimonial-scroll">
				<div class="container">
					<div class="row">
						<div class="col-md-12 text-center fh5co-heading">
							<span>Teman Dan Keluarga</span>
							<h2>Do'a dan Ucapan Terbaik</h2>
						</div>
						<div class="col-md-12">
							<div class="scroll-container">
								<div class="scroll-wrapper">
									<?php foreach ($testimoni as $index => $item): ?>
										<div class="card">
											<div class="card-body">
												<b><?php echo htmlspecialchars($item['nama']); ?></b><br>
												<span>
													<small><?php echo date('d/m/Y H:i', strtotime($item['datetime'])); ?></small>
												</span>
												<p>
													<i><?php echo html_entity_decode(htmlspecialchars($item['pesan'])); ?></i>
												</p>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="fh5co-started" class="fh5co-bg" style="background-image:url(<?php echo "$base_url"; ?>/assets/img/konten/gift_bg.png);">
				<div class="overlay"></div>
				<div class="container">
					<div class="row animate-box">
						<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
							<h2>Kirim Kado Pernikahan</h2>
						</div>
					</div>
					<div class="row animate-box">
						<div class="col-md-6 mb-3">
							<div class="card gift-information">
								<div class="card-body text-center">
									<h2 class="text-gift">Akun OVO</h2>
									<p class="text-gift">+6289637975560 (Siti Lestari)</p>
								</div>
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<div class="card gift-information">
								<div class="card-body text-center">
									<h2 class="text-gift">Alamat Pengiriman</h2>
									<p class="text-gift">
										Jalan Anggrek 4 No 15 RT 20 RW 04<br>
										Perumnas-Ciporang Kabupaten Kuningan
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="fh5co-gallery">
				<div class="container">
					<div class="row row-bottom-padded-md">
						<div class="col-md-12">
							<ul id="fh5co-gallery-list">
								<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(<?php echo "$base_url"; ?>/assets/img/konten/1.png); "> 
								<!-- <a href="images/gallery-1.jpg">
									<div class="case-studies-summary">
										<span>14 Photos</span>
										<h2>Two Glas of Juice</h2>
									</div>
								</a> -->
							</li>
							<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(<?php echo "$base_url"; ?>/assets/img/konten/2.png); ">
								<!-- <a href="#" class="color-2">
									<div class="case-studies-summary">
										<span>30 Photos</span>
										<h2>Timer starts now!</h2>
									</div>
								</a> -->
							</li>
							<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(<?php echo "$base_url"; ?>/assets/img/konten/3.png); ">
								<!-- <a href="#" class="color-3">
									<div class="case-studies-summary">
										<span>90 Photos</span>
										<h2>Beautiful sunset</h2>
									</div>
								</a> -->
							</li>
							<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(<?php echo "$base_url"; ?>/assets/img/konten/4.png); ">
								<!-- <a href="#" class="color-4">
									<div class="case-studies-summary">
										<span>12 Photos</span>
										<h2>Company's Conference Room</h2>
									</div>
								</a> -->
							</li>

								<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(<?php echo "$base_url"; ?>/assets/img/konten/5.png); ">
									<!-- <a href="#" class="color-3">
										<div class="case-studies-summary">
											<span>50 Photos</span>
											<h2>Useful baskets</h2>
										</div>
									</a> -->
								</li>
								<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(<?php echo "$base_url"; ?>/assets/img/konten/6.png); ">
									<!-- <a href="#" class="color-4">
										<div class="case-studies-summary">
											<span>45 Photos</span>
											<h2>Skater man in the road</h2>
										</div>
									</a> -->
								</li>
								<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(<?php echo "$base_url"; ?>/assets/img/konten/7.png); ">
									<!-- <a href="<?php echo "$base_url"; ?>/assets/img/konten/gallery-7.png" class="color-4">
										<div class="case-studies-summary">
											<span>35 Photos</span>
											<h2>Two Glas of Juice</h2>
										</div>
									</a> -->
								</li>
								<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(<?php echo "$base_url"; ?>/assets/img/konten/8.png); "> 
									<!-- <a href="#" class="color-5">
										<div class="case-studies-summary">
											<span>90 Photos</span>
											<h2>Timer starts now!</h2>
										</div>
									</a> -->
								</li>
								<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(<?php echo "$base_url"; ?>/assets/img/konten/9.png); ">
									<!-- <a href="<?php echo "$base_url"; ?>/assets/img/konten/gallery-9.png" class="color-6">
										<div class="case-studies-summary">
											<span>56 Photos</span>
											<h2>Beautiful sunset</h2>
										</div>
									</a> -->
								</li>
							</ul>		
						</div>
					</div>
				</div>
			</div>

		<div id="fh5co-counter" class="fh5co-bg fh5co-counter" style="background-image:url(<?php echo "$base_url"; ?>/assets/img/konten/ezgif-7-2675b232af.gif);">
			<div class="overlay"></div>
			<div class="container">
				<div class="row">
					<div class="display-t">
						<div class="display-tc">
							<div class="col-md-4 col-sm-12 animate-box">
								<div class="feature-center">
									<span class="icon">
										<i class="icon icon-tag"></i>
									</span>
									<span class="counter js-counter" data-from="0" data-to="<?php echo $JumlahAttender; ?>" data-speed="5000" data-refresh-interval="50">1</span>
									<span class="counter-label">Estimasi Tamu</span>

								</div>
							</div>
							<div class="col-md-4 col-sm-12 animate-box">
								<div class="feature-center">
									<span class="icon">
										<i class="icon icon-paper-plane"></i>
									</span>

									<span class="counter js-counter" data-from="0" data-to="<?php echo $JumlahKontak; ?>" data-speed="5000" data-refresh-interval="50">1</span>
									<span class="counter-label">Jumlah Undangan</span>
								</div>
							</div>
							<div class="col-md-4 col-sm-12 animate-box">
								<div class="feature-center">
									<span class="icon">
										<i class="icon icon-eye"></i>
									</span>
									<span class="counter js-counter" data-from="0" data-to="<?php echo $total_visitors; ?>" data-speed="5000" data-refresh-interval="50">1</span>
									<span class="counter-label">Halaman Dilihat</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="fh5co-testimonial">
			<div class="container">
				<div class="row">
					<div class="row animate-box">
						<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
							<h2>Lokasi Acara</h2>
							<span>
								<b>Mayang Catering</b><br>
								Kebon Kaisar (Jl. RE. Martadinata No.176, Ciporang Kuningan)
							</span>
						</div>
						<div class="col-md-8 col-md-offset-2 text-center">
							<a href="https://maps.app.goo.gl/XfSrLby4LqwniEHo9" class="Link-Lokasi">
								<i class="icon icon-map2"></i> Lihat Lokasi
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="fh5co-started" class="fh5co-bg" style="background-image:url(<?php echo "$base_url"; ?>/assets/img/konten/bg_anim1.png);">
			<div class="overlay"></div>
			<div class="container">
				<div class="row animate-box">
					<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
						<h2>Konfirmasi Kehadiran</h2>
						<p><?php echo "$subtitle_2_page_2"; ?></p>
						<p><i>Wassalamu’alaikum Wr Wb</i></p>
					</div>
				</div>
				<div class="row animate-box">
					<div class="col-md-12 col-md-offset-1">
						<form action="javascript:void(0);" class="form-inline" id="ProsesKonfirmasiKehadiran">
							<div class="col-md-3">
								<div class="form-group">
									<label for="nama" class="sr-only">Nama</label>
									<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="kontak" class="sr-only">Kontak (Wa)</label>
									<input type="text" class="form-control" id="kontak" name="kontak" placeholder="Kontak">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="email" class="sr-only">Email</label>
									<input type="text" class="form-control" id="email" name="email" placeholder="Email">
								</div>
							</div>
							<div class="col-md-3">
								<button type="submit" class="btn btn-default btn-block" id="TombolKonfirmasi">Konfirmasi</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal untuk menampilkan kirim pesan sukses -->
		<div id="ModalKirimPesanBerhasil" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content border-0">
					<div class="modal-body border-0 bg-success">
						<div class="row mb-3 mt-5">
							<div class="col-md-12 text-center">
								
							</div>
						</div>
						<div class="row mb-3 mt-5">
							<div class="col-md-12 text-center">
								<h3>Kirim Pesan Berhasil</h3>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 text-center">
								<p>
									<i>Terima kasih sudah mengirimkan pesan ucapan dalam acara pernikahan kami.</i>
								</p>
							</div>
							<div class="col-md-12 text-center">
								<small>
									<i>Kami akan segera melakukan verifikasi untuk setiap pesan yang sudah masuk</i>
								</small>
							</div>
						</div>
					</div>
					<div class="modal-footer border-0">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal untuk menampilkan kirim pesan gagal -->
		<div id="ModalKirimPesanGagal" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Kirim Pesan Gagal</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p class="text-danger" id="NotifikasiKirimPesanGagal">
							<!-- Penyebab kegagalan akan ditampilkan disini -->
						</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal untuk menampilkan pesan sukses -->
		<div id="modalBerhasil" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content border-0">
					<div class="modal-body border-0 bg-success">
						<div class="row mb-3 mt-5">
							<div class="col-md-12 text-center">
								
							</div>
						</div>
						<div class="row mb-3 mt-5">
							<div class="col-md-12 text-center">
								<h3>Konfirmasi Berhasil</h3>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 text-center">
								<p>
									<i>Terima kasih sudah mengisi konfirmasi kehadiran dalam acara pernikahan kami</i>
								</p>
							</div>
						</div>
					</div>
					<div class="modal-footer border-0">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal untuk menampilkan pesan gagal -->
		<div id="modalGagal" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Konfirmasi Gagal</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p class="text-danger" id="NotifikasiProsesGagal">
							<!-- Penyebab kegagalan akan ditampilkan disini -->
						</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal -->
        <div class="modal fade" id="welcomeModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content" style="background-image:url(<?php echo "$base_url"; ?>/assets/img/konten/<?php echo "$background_page3"; ?>);">
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								<?php
									if(!empty($NamaUndangan)){
										echo '<h1 class="NamaUndangan">Yth. '.$NamaUndangan.'</h1>';
									}
								?>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-md-12 text-center">
								<span>UNDANGAN PERNIKAHAN</span>
								<h1>Adi & Tari</h1>
								<small>29 September 2024</small>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-md-12 text-center">
								<p><br></p>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-md-12 text-center mb-3">
								<button type="button" class="btn btn-primary" id="startMusicButton">
									Lihat Undangan
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<footer id="fh5co-footer" role="contentinfo">
			<div class="container">
				<div class="row copyright">
					<div class="col-md-12 text-center">
						<p>
							<small class="block">&copy; 2024 Parasilva Technology. All Rights Reserved.</small> 
							<small class="block">Designed by <a href="https://parasilva.tech/" target="_blank">Parasilva Technology</a></small>
						</p>
						<!-- <p>
							<ul class="fh5co-social-icons">
								<li><a href="#"><i class="icon-instagram"></i></a></li>
								<li><a href="#"><i class="icon-facebook"></i></a></li>
								<li><a href="#"><i class="icon-linkedin"></i></a></li>
								<li><a href="#"><i class="icon-dribbble"></i></a></li>
							</ul>
						</p> -->
						<!-- Audio -->
						<audio id="backgroundMusic" controls loop>
							<source src="<?php echo "$base_url"; ?>/assets/img/konten/music.mp3" type="audio/mpeg">
							Your browser does not support the audio element.
						</audio>
					</div>
				</div>
			</div>
		</footer>
		</div>
		<div class="gototop js-top">
			<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
		</div>
		<!-- jQuery -->
		<script src="js/jquery.min.js"></script>
		<!-- jQuery Easing -->
		<script src="js/jquery.easing.1.3.js"></script>
		<!-- Bootstrap -->
		<script src="js/bootstrap.min.js"></script>
		<!-- Waypoints -->
		<script src="js/jquery.waypoints.min.js"></script>
		<!-- Carousel -->
		<script src="js/owl.carousel.min.js"></script>
		<!-- countTo -->
		<script src="js/jquery.countTo.js"></script>
		<!-- Stellar -->
		<script src="js/jquery.stellar.min.js"></script>
		<!-- Magnific Popup -->
		<script src="js/jquery.magnific-popup.min.js"></script>
		<script src="js/magnific-popup-options.js"></script>
		<!-- // <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/0.0.1/prism.min.js"></script> -->
		<script src="js/simplyCountdown.js"></script>
		<!-- Main -->
		<script src="js/main.js"></script>
		<script src="js/custome.js"></script>
	</body>
</html>


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
?>
<!DOCTYPE html>
<html class="no-js">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php echo "$title_page"; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="<?php echo "$deskripsi"; ?>" />
		<meta name="keywords" content="<?php echo "$kata_kunci"; ?>" />
		<meta name="author" content="<?php echo "$author"; ?>" />
		<!-- Favicons -->
		<link href="<?php echo "$base_url"; ?>/assets/img/<?php echo "$favicon"; ?>" rel="icon">
		<link href="<?php echo "$base_url"; ?>/assets/img/<?php echo "$favicon"; ?>" rel="apple-touch-icon">
		<meta property="og:title" content=""/>
		<meta property="og:image" content=""/>
		<meta property="og:url" content=""/>
		<meta property="og:site_name" content=""/>
		<meta property="og:description" content=""/>
		<meta name="twitter:title" content="" />
		<meta name="twitter:image" content="" />
		<meta name="twitter:url" content="" />
		<meta name="twitter:card" content="" />
		<link href='https://fonts.googleapis.com/css?family=Work+Sans:400,300,600,400italic,700' rel='stylesheet' type='text/css'>
		<link href="https://fonts.googleapis.com/css?family=Sacramento" rel="stylesheet">
		<!-- Animate.css -->
		<link rel="stylesheet" href="css/animate.css">
		<!-- Icomoon Icon Fonts-->
		<link rel="stylesheet" href="css/icomoon.css">
		<!-- Bootstrap  -->
		<link rel="stylesheet" href="css/bootstrap.css">
		<!-- Magnific Popup -->
		<link rel="stylesheet" href="css/magnific-popup.css">
		<!-- Owl Carousel  -->
		<link rel="stylesheet" href="css/owl.carousel.min.css">
		<link rel="stylesheet" href="css/owl.theme.default.min.css">
		<!-- Theme style  -->
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/custome.css">
		<!-- Modernizr JS -->
		<script src="js/modernizr-2.6.2.min.js"></script>
		<!-- FOR IE9 below -->
		<!--[if lt IE 9]>
		<script src="js/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="fh5co-loader"></div>
		<audio autoplay loop>
			<source src="<?php echo "$base_url"; ?>/assets/img/konten/music.mp3" type="audio/mpeg">
			Your browser does not support the audio element.
		</audio>
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
							<!-- <ul>
								<li class="active"><a href="index.html">Home</a></li>
								<li><a href="about.html">Story</a></li>
								<li class="has-dropdown">
									<a href="services.html">Services</a>
									<ul class="dropdown">
										<li><a href="#">Web Design</a></li>
										<li><a href="#">eCommerce</a></li>
										<li><a href="#">Branding</a></li>
										<li><a href="#">API</a></li>
									</ul>
								</li>
								<li class="has-dropdown">
									<a href="gallery.html">Gallery</a>
									<ul class="dropdown">
										<li><a href="#">HTML5</a></li>
										<li><a href="#">CSS3</a></li>
										<li><a href="#">Sass</a></li>
										<li><a href="#">jQuery</a></li>
									</ul>
								</li>
								<li><a href="contact.html">Contact</a></li>
							</ul> -->
						</div>
					</div>
				</div>
			</nav>
			<header id="fh5co-header" class="fh5co-cover" role="banner" style="background-image:url(<?php echo "$base_url"; ?>/assets/img/konten/<?php echo "$background_page_1"; ?>);" data-stellar-background-ratio="0.5">
				<div class="overlay"></div>
				<div class="snowflakes"></div> <!-- Kontainer untuk salju -->
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
			<div id="fh5co-couple">
				<div class="container mb-5">
					<div class="row">
						<div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box">
							<h2><?php echo "$title_page_2"; ?></h2>
							<?php
								//Apabila ID Undangan ada
								if(!empty($NamaUndangan)){
									echo '<h3>Yth. '.$NamaUndangan.'</h3>';
								}
							?>
							<p><?php echo "$subtitle_1_page_2"; ?></p>
							<p></p>
						</div>
					</div>
					<div class="couple-wrap animate-box mb-5">
						<div class="couple-half">
							<div class="groom">
								<img src="<?php echo "$base_url"; ?>/assets/img/konten/<?php echo "$male_foto"; ?>" alt="groom" class="img-responsive">
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
								<span>Kelurahan Pisangan Baru<br>Matraman Jakarta Timur</span>
							</div>
						</div>
						<p class="heart text-center"><i class="icon-heart2"></i></p>
						<div class="couple-half">
							<div class="bride">
								<img src="<?php echo "$base_url"; ?>/assets/img/konten/<?php echo "$female_foto"; ?>" alt="groom" class="img-responsive">
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
								<span>Kelurahan Ciporang <br>Kabupaten Kuningan</span>
							</div>
						</div>
					</div>
					<p><br></p>
					<p><br></p>
					<p><br></p>
					<p><br></p>
					<p><br></p>
				</div>
			</div>
			<div id="fh5co-event" class="fh5co-bg" style="background-image:url(<?php echo "$base_url"; ?>/assets/img/konten/<?php echo "$background_page3"; ?>);">
				<div class="overlay"></div>
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box">
							<span><?php echo "$subtitle_page_3"; ?></span>
							<h2><?php echo "$title_page_3"; ?></h2>
						</div>
					</div>
					<div class="row">
						<div class="display-t">
							<div class="display-tc">
								<div class="col-md-12">
									<div class="col-md-3 col-sm-4 text-center">
										<div class="event-wrap animate-box">
											<h3>Hari, Tanggal</h3>
											<div class="event-col-12">
												<i class="icon-calendar"></i>
												<span><?php echo "$event_daydate_1"; ?></span>
											</div>
										</div>
									</div>
									<div class="col-md-3 col-sm-4 text-center">
										<div class="event-wrap animate-box">
											<h3>Jam</h3>
											<div class="event-col-12">
												<i class="icon-clock"></i>
												<span><?php echo "$event_start_2 s/d $event_end_2"; ?></span>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12 text-center">
										<div class="event-wrap animate-box">
											<h3>Tempat/Lokasi</h3>
											<div class="event-col-12">
												<i class="icon-map"></i>
												<span><?php echo "$event_place_1"; ?></span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="display-t">
							<div class="display-tc">
								<div class="col-md-12 mb-4">
									<div class="col-md-12 col-sm-12 text-center">
										<div class="event-wrap animate-box">
											<h3>Tempat/Lokasi</h3>
											<div class="event-col-12">
												<i class="icon-map"></i>
												<span><?php echo "$event_place_1"; ?></span>
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
					<p><br></p>
					<div class="row">
						<div class="col-md-12 text-center fh5co-heading animate-box">
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
			<div id="fh5co-gallery">
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box">
							<h2>Album foto</h2>
						</div>
					</div>
					<div class="row row-bottom-padded-md">
						<div class="col-md-12">
							<ul id="fh5co-gallery-list">
								<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(<?php echo "$base_url"; ?>/assets/img/konten/gallery-1.png); "> 
								<!-- <a href="images/gallery-1.jpg">
									<div class="case-studies-summary">
										<span>14 Photos</span>
										<h2>Two Glas of Juice</h2>
									</div>
								</a> -->
							</li>
							<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(<?php echo "$base_url"; ?>/assets/img/konten/gallery-2.png); ">
								<!-- <a href="#" class="color-2">
									<div class="case-studies-summary">
										<span>30 Photos</span>
										<h2>Timer starts now!</h2>
									</div>
								</a> -->
							</li>
							<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(<?php echo "$base_url"; ?>/assets/img/konten/gallery-3.png); ">
								<!-- <a href="#" class="color-3">
									<div class="case-studies-summary">
										<span>90 Photos</span>
										<h2>Beautiful sunset</h2>
									</div>
								</a> -->
							</li>
							<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(<?php echo "$base_url"; ?>/assets/img/konten/gallery-4.png); ">
								<!-- <a href="#" class="color-4">
									<div class="case-studies-summary">
										<span>12 Photos</span>
										<h2>Company's Conference Room</h2>
									</div>
								</a> -->
							</li>

								<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(<?php echo "$base_url"; ?>/assets/img/konten/gallery-5.png); ">
									<!-- <a href="#" class="color-3">
										<div class="case-studies-summary">
											<span>50 Photos</span>
											<h2>Useful baskets</h2>
										</div>
									</a> -->
								</li>
								<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(<?php echo "$base_url"; ?>/assets/img/konten/gallery-6.png); ">
									<!-- <a href="#" class="color-4">
										<div class="case-studies-summary">
											<span>45 Photos</span>
											<h2>Skater man in the road</h2>
										</div>
									</a> -->
								</li>
								<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(<?php echo "$base_url"; ?>/assets/img/konten/gallery-7.png); ">
									<!-- <a href="<?php echo "$base_url"; ?>/assets/img/konten/gallery-7.png" class="color-4">
										<div class="case-studies-summary">
											<span>35 Photos</span>
											<h2>Two Glas of Juice</h2>
										</div>
									</a> -->
								</li>
								<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(<?php echo "$base_url"; ?>/assets/img/konten/gallery-8.png); "> 
									<!-- <a href="#" class="color-5">
										<div class="case-studies-summary">
											<span>90 Photos</span>
											<h2>Timer starts now!</h2>
										</div>
									</a> -->
								</li>
								<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(<?php echo "$base_url"; ?>/assets/img/konten/gallery-9.png); ">
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

		<div id="fh5co-counter" class="fh5co-bg fh5co-counter" style="background-image:url(<?php echo "$base_url"; ?>/assets/img/konten/bg_anim2.webp);">
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
								Mayang Catering Kuningan<br>
								Jl. RE. Martadinata No.176, Ciporang, Kec. Kuningan, Kabupaten Kuningan, Jawa Barat 45514
							</span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 animate-box">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d247.52067911836815!2d108.50474506616595!3d-6.970237115524026!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f16a401c132ef%3A0x567725693179992d!2sMayang%20Catering%20Kuningan!5e0!3m2!1sen!2sid!4v1726581297956!5m2!1sen!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
						</div>
					</div>
				</div>
			</div>
		</div>
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
		<div id="fh5co-started" class="fh5co-bg" style="background-image:url(<?php echo "$base_url"; ?>/assets/img/konten/bg_anim1.gif);">
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
		<script>
			// default example
			simplyCountdown('.simply-countdown-one', {
				year: 2024,
				month: 09,
				day: 29,
				hours: 0,
				minutes: 0,
				seconds: 0
			});
			document.addEventListener('DOMContentLoaded', function() {
				let header = document.querySelector('#fh5co-header .snowflakes'); // Target container untuk salju

				let numFlakes = 100; // Jumlah salju yang ingin ditampilkan
				for (let i = 0; i < numFlakes; i++) {
					let flake = document.createElement('div');
					flake.className = 'snowflake';
					flake.style.left = Math.random() * 100 + 'vw'; // Menentukan posisi horizontal secara acak
					// Meningkatkan durasi animasi untuk memperlambat turunnya salju
					flake.style.animationDuration = (Math.random() * 10) + 5 + 's'; // Ubah angka di sini, semakin besar semakin lambat
					flake.style.animationDelay = Math.random() * 5 + 's'; // Delay untuk membuat salju tidak jatuh bersamaan
					header.appendChild(flake);
				}
			});
			$(document).ready(function() {
				let $verses = $(".quran-verse");
				let index = 0;

				// Mencari ketinggian maksimum dari semua elemen quran-verse
				let maxHeight = 0;
				$verses.each(function() {
					let height = $(this).outerHeight();
					if (height > maxHeight) {
						maxHeight = height;
					}
				});
				// Mengatur ketinggian kontainer sesuai dengan elemen yang paling tinggi
				$(".fh5co-heading").css("min-height", maxHeight);
				function showNextVerse() {
					$verses.eq(index).fadeOut(1000, function() {
						// Callback setelah elemen menghilang
						index = (index + 1) % $verses.length; // Mengatur indeks ke elemen berikutnya
						$verses.eq(index).fadeIn(1000); // Menampilkan elemen berikutnya dengan efek fade
					});
					setTimeout(showNextVerse, 5000); // Menampilkan elemen berikutnya setelah 5 detik
				}
				$verses.eq(index).fadeIn(1000); // Menampilkan elemen pertama dengan efek fade
				setTimeout(showNextVerse, 5000); // Memulai animasi setelah 5 detik

				$("#ProsesKonfirmasiKehadiran").submit(function(event) {
					event.preventDefault(); // Mencegah form submit default
					let $button = $("#TombolKonfirmasi");
					$button.text('Loading...'); // Ubah teks tombol menjadi "Loading..."

					// Mengirimkan data form menggunakan AJAX
					$.ajax({
						url: '_Config/ProsesKonfirmasi.php', // URL untuk mengirim data
						type: 'POST',
						data: $(this).serialize(), // Mengambil semua data form
						dataType: 'json', // Mengharapkan response JSON
						success: function(response) {
							if (response.success) {
								$('#ProsesKonfirmasiKehadiran')[0].reset(); // Reset form
								$('#modalBerhasil').modal('show'); // Tampilkan modal sukses
							} else {
								// Tampilkan modal gagal dengan pesan error
								$('#NotifikasiProsesGagal').text(response.message);
								$('#modalGagal').modal('show');
							}
						},
						error: function(xhr, status, error) {
							// Debugging: Tampilkan error response di console
							console.log("Error Status: ", status);
							console.log("Error Thrown: ", error);
							console.log("Response Text: ", xhr.responseText);
							alert('Terjadi kesalahan, silakan coba lagi.');
						},
						complete: function() {
							$button.text('Konfirmasi'); // Kembalikan teks tombol menjadi "Konfirmasi"
						}
					});
				});
			});
		</script>
	</body>
</html>


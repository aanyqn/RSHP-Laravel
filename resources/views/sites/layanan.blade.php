<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Kami</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navigation">
        <a class="navigation-list" href="{{ route('home') }}"><p>HOME</p></a>
        <a class="navigation-list" href="{{ route('struktur') }}"><p>STRUKTUR ORGANISASI</p></a></a>
        <a class="navigation-list" href="{{ route('layanan') }}"><p>LAYANAN UMUM</p></a></a>
        <a class="navigation-list" href="{{ route('visimisi') }}"><p>VISI MISI DAN TUJUAN</p></a>
        <a class="navigation-list" href="{{ route('login') }}"><button class="login-button"><strong>LOGIN</strong></button></a>
        <img src="/img/logo.png" alt="logo-unair" width="400px" height="50">
    </nav>

    <section class="layanan" id="layanan-section" style="padding: 30px;">
        <h2>Layanan Umum</h2>
        <h3>Poliklinik</h3>
        <p>Poliklinik adalah layanan rawat jalan dimana pelayanan kesehatan hewan dilakukan tanpa pasien menginap. Poliklinik melayani tindakan observasi, diagnosis, pengobatan, rehabilitasi medik, serta pelayanan kesehatan lainnya seperti permintaan surat keterangan sehat. Tindakan observasi dan diagnosis, juga bisa diteguhkan dengan berbagai macam pemeriksaan yang bisa kami lakukan, misalnya pemeriksaan sitologi, dermatologi, hematologi, atau pemeriksaan radiologi, ultrasonografi, bahkan pemeriksaan elektrokardiografi. Bilamana diperlukan pemeriksaan-pemeriksaan lain yang diperlukan seperti pemeriksaan kultur bakteri, atau pemeriksaan jaringan/histopatologi, dan lain-lain kami bekerja sama dengan Fakultas Kedokteran Hewan Universitas Airlangga untuk membantu melakukan pemeriksaan-pemeriksaan tersebut. Selain itu kami mempunyai rapid test untuk pemeriksaan cepat, untuk meneguhkan diagnosa penyakit-penyakit berbahaya pada kucing seperti panleukopenia, calicivirus, rhinotracheitis, FIP, dan pada anjing seperti parvovirus, canine distemper.</p>
        <ul>
            <li>Rawat jalan</li>
            <li>Vaksinasi</li>
            <li>Akupuntur</li>
            <li>Kemoterapi</li>
            <li>Fisioterapi</li>
            <li>Mandi terapi</li>
        </ul>
    </section>
</body>
</html>

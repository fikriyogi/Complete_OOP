<?php

// koneksi ke database
$conn = mysqli_connect('localhost', 'root', '', 'fb_clone');
function timeago($date) {
    $timestamp = strtotime($date);

    $strTime = array("second", "minute", "hour", "day", "month", "year");
    $length = array("60","60","24","30","12","10");

    $currentTime = time();
    if($currentTime >= $timestamp) {
        $diff     = time()- $timestamp;
        for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
            $diff = $diff / $length[$i];
        }

        $diff = round($diff);
        return $diff . " " . $strTime[$i] . "(s) ago ";
    }
}
function slug($url) {
    $slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($url)));
    return $slug;
}
function tgl_indo($tanggal){
    $timestamp = strtotime($tanggal);
    $date = date('d-m-Y', $timestamp);

    $bulan = array (
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $date);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[0] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[2];
}

// This function will take $_SERVER['REQUEST_URI'] and build a breadcrumb based on the user's current path
function breadcrumbs($separator = ' &raquo; ', $home = 'Home') {
    // This gets the REQUEST_URI (/path/to/file.php), splits the string (using '/') into an array, and then filters out any empty values
    $path = array_filter(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));

    // This will build our "base URL" ... Also accounts for HTTPS :)
    $base = ($_SERVER['HTTPS'] ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';

    // Initialize a temporary array with our breadcrumbs. (starting with our home page, which I'm assuming will be the base URL)
    $breadcrumbs = Array("<a href=\"$base\">$home</a>");

    // Find out the index for the last value in our path array
    $last = end(array_keys($path));

    // Build the rest of the breadcrumbs
    foreach ($path AS $x => $crumb) {
        // Our "title" is the text that will be displayed (strip out .php and turn '_' into a space)
        $title = ucwords(str_replace(Array('.php', '_'), Array('', ' '), $crumb));

        // If we are not on the last index, then display an <a> tag
        if ($x != $last)
            $breadcrumbs[] = "<a href=\"$base$crumb\">$title</a>";
        // Otherwise, just display the title (minus)
        else
            $breadcrumbs[] = $title;
    }

    // Build our temporary array (pieces of bread) into one big string :)
    return implode($separator, $breadcrumbs);
}


function artikelTerkait($id)
{
    // batas threshold 40%
    $threshold = 40;
    // jumlah maksimum post terkait yg ditampilkan 3 buah
    $maksArtikel = 3;

    // array yang nantinya diisi title post terkait
    $listArtikel = Array();

    // membaca title post dari ID tertentu (ID post acuan)
    // title ini nanti akan dicek kemiripannya dengan post yang lain
    $query = "SELECT title FROM post WHERE id = '$id'";
    $hasil = mysqli_query($conn, $query);
    $data  = mysqli_fetch_array($hasil);
    $title = $data['title'];

    // membaca semua data post selain ID post acuan
    $query = "SELECT id, title FROM post WHERE id <> '$id'";
    $hasil = mysqli_query($conn, $query);
    while ($data = mysqli_fetch_array($hasil))
    {
        // cek similaritas title post acuan dengan title post lainnya
        similar_text($title, $data['title'], $percent);
        if ($percent >= $threshold)
        {
            // jika prosentase kemiripan title di atas threshold
            if (count($listArtikel) <= $maksArtikel)
            {
                // jika jumlah post belum sampai batas maksimum, tambahkan ke dalam array
                $listArtikel[] = "<li><a href='post.php?id=".$data['id']."'>".$data['title']."</a></li>";
            }
        }
    }

    // jika array listartikel tidak kosong, tampilkan listnya
    // jika kosong, maka tampilkan 'tidak ada post terkait'
    if (count($listArtikel) > 0)
    {
        echo "<ul>";
        for ($i=0; $i<=count($listArtikel)-1; $i++)
        {
            echo $listArtikel[$i];
        }
        echo "</ul>";
    }
    else echo "<p>Tidak ada post terkait</p>";
}
?>
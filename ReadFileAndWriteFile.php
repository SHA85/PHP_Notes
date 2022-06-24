<html>

<head>
    <title>Reading a file using PHP</title>
</head>

<body>
    <?php
    // Read File
    $read_file_name = "Unique-TotalHWords_32885_10.2.2012.txt";
    $read_file = fopen( $read_file_name, "r" );

    // Write File
    $writ_file_name = "output.sql";
    $write_file = fopen( $writ_file_name, "w" );

    if( $read_file == false ) {
        echo ( "Error in opening file" );
        exit();
    }

    while(! feof($read_file))  {
        $result = fgets($read_file);
        $result = trim($result);   
        fwrite( $write_file, "INSERT INTO `words` (`id`, `word`) VALUES (NULL, '".$result."');");
    }

    fclose($read_file);

    // fwrite( $file, "This is  a simple test\n" );
    fclose( $write_file );
    ?>
</body>
</html>
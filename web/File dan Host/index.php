<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Referer Example</title>
    <style>
        .container {
            max-width: 600px;
            margin: 50px auto;
            text-align: center;
        }
        .button-group {
            margin-bottom: 20px;
        }
        button {
            padding: 10px;
            margin: 5px;
            cursor: pointer;
        }
        .output {
            border: 1px solid #ccc;
            padding: 20px;
            min-height: 100px;
            background-color: #f9f9f9;
            max-height: 200px;
            overflow-y: auto;
            position: relative;
        }
        .output::-webkit-scrollbar {
            width: 8px;
        }
        .output::-webkit-scrollbar-track {
            background: transparent;
        }
        .output::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.3);
            border-radius: 10px;
        }
        .output::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Halo Aku Referal</h1>
    <div class="button-group">
        <form method="POST" action="index.php">
            <button type="submit" name="file" value="aldo.txt">Aldo</button>
            <button type="submit" name="file" value="boni.txt">Boni</button>
            <button type="submit" name="file" value="cici.txt">Cici</button>
            <button type="submit" name="file" value="doni.txt">Doni</button>
            <button type="submit" name="file" value="eman.txt">Eman</button>
        </form>
    </div>
    <div class="output">
        <?php
        if (isset($_SERVER['HTTP_REFERER'])) {
            $referer = $_SERVER['HTTP_REFERER'];
            $parsed_url = parse_url($referer);
            
            // Extract host and query parameters
            $host = isset($parsed_url['host']) ? $parsed_url['host'] : '';
            $query = isset($parsed_url['query']) ? $parsed_url['query'] : '';
            parse_str($query, $query_params);
            
            // Check if file parameter exists
            if (isset($query_params['file'])) {
                $file = $query_params['file'];
                
                // Check if requesting flag file
                if ($file === '/etc/flag.txt') {
                    // Check if referer host matches allowed IPs
                    if ($host === '017700000001' || $host === '127.1' || $host === '2130706433') {
                        // Read and display flag content
                        $flag_content = @file_get_contents($file);
                        if ($flag_content !== false) {
                            echo nl2br(htmlspecialchars($flag_content));
                        } else {
                            echo "Not Found kak";
                        }
                    } else {
                        echo "Akses ke flag ditolak. Invalid host: " . htmlspecialchars($host);
                    }
                } else {
                    // Handle regular files
                    $safe_file = "list/" . basename($file);
                    if (file_exists($safe_file)) {
                        echo nl2br(htmlspecialchars(file_get_contents($safe_file)));
                    } else {
                        echo "Gak ada filenya.";
                    }
                }
            } else {
                echo "File parameter tidak ditemukan di referer.";
            }
        } else {
            echo "Referer header tidak ditemukan.";
        }
        ?>
    </div>
</div>
<script>
document.querySelectorAll('button').forEach(button => {
    button.addEventListener('click', function() {
        let file = this.value;
        let referer = window.location.href.split('?')[0] + '?file=' + file;
        history.replaceState(null, '', referer);
    });
});
</script>
</body>
</html>

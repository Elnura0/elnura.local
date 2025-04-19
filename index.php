<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Анкета катышуучулар</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fcd2e2; /* Розовый фон */
            margin: 0;
            padding: 20px;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        .entry {
            background-color: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-around;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .entry img {
            width: 200px;
            height: auto;
            border-radius: 10px;
        }

        .info {
            text-align: left;
            flex: 1;
            margin-left: 20px;
        }

        .qr {
            text-align: center;
        }

        h2 {
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>
    <h2>Катышуучулардын анкетасы</h2>
    <div class="container">
        <?php
        // JSON файлынан маалыматтарды алуу
        $dataFile = 'data.json';
        $dataList = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : [];

        // Маалыматтарды көрсөтүү
        foreach ($dataList as $entry):
            if (empty($entry['photo'])) continue; // Эгер фото жок болсо, өткөрүп жибер
        ?>
            <div class="entry">
                <!-- Фото -->
                <img src="<?= htmlspecialchars($entry['photo']) ?>" alt="Фото">
                
                <!-- Маалымат -->
                <div class="info">
                    <p><strong><?= htmlspecialchars($entry['name']) ?></strong></p>
                    <p>Жашы: <?= htmlspecialchars($entry['age']) ?></p>
                    <p><?= htmlspecialchars($entry['about']) ?></p>
                </div>
                
                <!-- WhatsApp жана QR код -->
                <div class="qr">
                    <p><a href="https://wa.me/<?= urlencode($entry['055304456']) ?>" target="_blank">
                        <?= htmlspecialchars($entry['whatsapp']) ?>
                    </a></p>
                    <img src="https://api.qrserver.com/v1/create-qr-code/?data=https://wa.me/<?= urlencode($entry['whatsapp']) ?>&size=150x150" alt="QR код">
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Workout API</title>
    <style>
        .exercise-card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .exercise-card h2 {
            margin-top: 0;
        }
        .exercise-card p {
            margin: 0 0 10px;
        }
    </style>
</head>
<body>
    <?php
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://exercises-by-api-ninjas.p.rapidapi.com/v1/exercises?type=cardio&difficulty=advanced",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: exercises-by-api-ninjas.p.rapidapi.com",
            "X-RapidAPI-Key: 4a4a31891dmsh9109286e220398dp1b6baajsn85aecd10f3ff"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $data = json_decode($response, true);

        if (!empty($data)) {
            foreach ($data as $exercise) {
                echo "<div class='exercise-card'>";
                echo "<h2>" . $exercise['name'] . "</h2>";
                echo "<p><strong>Type:</strong> " . $exercise['type'] . "</p>";
                echo "<p><strong>Muscle:</strong> " . $exercise['muscle'] . "</p>";
                echo "<p><strong>Equipment:</strong> " . $exercise['equipment'] . "</p>";
                echo "<p><strong>Difficulty:</strong> " . $exercise['difficulty'] . "</p>";
                echo "<h3>Instructions:</h3>";
                echo "<p>" . $exercise['instructions'] . "</p>";
                echo "</div>";
            }
        } else {
            echo "No exercises found";
        }
    }
    ?>
</body>
</html>

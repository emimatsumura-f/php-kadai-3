<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>猫の健康観察</title>
</head>

<body>
    <form action="healthcare_txt_create.php" method="post" id="healthcare-form">
        <fieldset>
            <legend>今日の記録</legend>
            <div>
                日付: <input type="date" name="date">
            </div>
            <div>
                <label for="weight">体重 (kg):</label>
                <input type="number" id="weight" name="weight" step="0.1" oninput="calculatePeeRatio()" />
            </div>
            <div>
                <label for="pee">尿量 (ml):</label>
                <input type="number" id="pee" name="pee" required oninput="calculatePeeRatio()" />
                <input type="hidden" id="pee_ratio_result" name="pee_ratio_result">
                <div id="pee_ratio_display"></div>
            </div>
            <div>
                <label for="toilet_times">トイレに行った回数 (回):</label>
                <input type="number" id="toilet_times" name="toilet_times" required />
            </div>
            <div>
                <label for="poop">💩:</label>
                <select id="poop" name="poop" required>
                    <option value="">選択してください</option>
                    <option value="yes">OK</option>
                    <option value="no">NO</option>
                </select>
            </div>
            <button type="submit">送信</button>
            <p>⚠️尿量/体重が40を上回ると、病気により尿量が増えている可能性があります。診察を検討しましょう！</p>

            <a href="healthcare_csv_create.php">csvダウンロード</a>
        </fieldset>
    </form>
    <script>
        function calculatePeeRatio() {
            const weight = parseFloat(document.getElementById("weight").value);
            const pee = parseFloat(document.getElementById("pee").value);
            let result = "";
            if (!isNaN(weight) && !isNaN(pee) && weight > 0) {
                const ratio = pee / weight;
                result = "尿量/体重: " + ratio.toFixed(2) + " ml/kg";
                document.getElementById("pee_ratio_result").value = ratio.toFixed(2);
            }
            document.getElementById("pee_ratio_display").innerText = result;
        }
    </script>
</body>

</html>
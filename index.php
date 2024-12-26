<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>猫の健康観察</title>
    <style>
        .entry {
            margin-bottom: 10px;
            border: 1px solid #ddd;
            padding: 10px;
        }
    </style>
</head>

<body>
    <form
        action="create.php"
        method="post"
        id="healthcare-form">
        <fieldset>
            <legend>
                <h3>今日の記録</h3>
            </legend>

            <div>
                <label for="input_date">日付:</label>
                <input
                    type="date"
                    id="input_date"
                    name="input_date"
                    required />
            </div>

            <div id="entries-container">
                <!-- 最初の入力エントリー -->
                <div class="entry" data-entry-number="1">
                    <h3>1回目の記録</h3>
                    <div>
                        <label for="weight1">体重 (kg):</label>
                        <input
                            type="number"
                            id="weight1"
                            name="weight[]"
                            step="0.1"
                            class="weight-input" />
                    </div>
                    <div>
                        <label for="pee1">尿量 (ml):</label>
                        <input
                            type="number"
                            id="pee1"
                            name="pee[]"
                            class="pee-input" />
                    </div>
                </div>
            </div>

            <button type="button" id="add-entry-btn">+ 記録を追加</button>

            <div>
                <label for="total-pee">尿量合計 (ml):</label>
                <input
                    type="number"
                    id="total-pee"
                    name="total_pee"
                    readonly />
            </div>

            <div>
                <label for="manual-pee-ratio">尿量/体重 (ml/kg):</label>
                <input
                    type="number"
                    id="manual-pee-ratio"
                    name="manual_pee_ratio"
                    step="0.01" />
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
            <p>
                ⚠️尿量/体重が40を上回ると、病気により尿量が増えている可能性があります。診察を検討しましょう！
            </p>
        </fieldset>
    </form>

    <script>
        // ページ読み込み時に実行
        window.onload = function() {
            // 入力日を今日の日付に自動設定
            const today = new Date();
            document.getElementById("input_date").valueAsDate = today;
        };

        // エントリー追加機能
        let entryCounter = 1;
        document
            .getElementById("add-entry-btn")
            .addEventListener("click", function() {
                entryCounter++;
                const newEntry = document.createElement("div");
                newEntry.classList.add("entry");
                newEntry.dataset.entryNumber = entryCounter;
                newEntry.innerHTML = `
                <h3>${entryCounter}回目の記録</h3>
                <div>
                    <label for="weight${entryCounter}">体重 (kg):</label>
                    <input type="number" id="weight${entryCounter}" name="weight[]" step="0.1" class="weight-input">
                </div>
                <div>
                    <label for="pee${entryCounter}">尿量 (ml):</label>
                    <input type="number" id="pee${entryCounter}" name="pee[]" class="pee-input">
                    
                </div>
            `;
                document
                    .getElementById("entries-container")
                    .appendChild(newEntry);

                // 入力イベントリスナーを新しい要素に追加
                addInputListeners();
            });

        // 入力イベントリスナーを追加する関数
        function addInputListeners() {
            // 尿量入力のリスナー
            const peeInputs = document.querySelectorAll(".pee-input");
            peeInputs.forEach((input) => {
                input.addEventListener("input", calculateTotalPee);
            });
        }

        // 尿量合計を計算
        function calculateTotalPee() {
            const peeInputs = document.querySelectorAll(".pee-input");
            let totalPee = 0;
            peeInputs.forEach((input) => {
                const value = parseFloat(input.value);
                if (!isNaN(value)) {
                    totalPee += value;
                }
            });
            document.getElementById("total-pee").value =
                totalPee.toFixed(1);
        }

        // 初期状態でイベントリスナーを追加
        addInputListeners();
    </script>
</body>

</html>
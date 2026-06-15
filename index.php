<?php
$tableResult = '';
$sumResult = '';
$numberValue = '';
$firstValue = '';
$secondValue = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'table') {
        $numberValue = $_POST['number'] ?? '';
        $number = filter_var($numberValue, FILTER_VALIDATE_INT);
        if ($number === false) {
            $tableResult = '<div class="result error">กรุณาป้อนตัวเลขที่ถูกต้อง</div>';
        } else {
            $tableResult = '<div class="result"><h3>ตารางสูตรคูณของ ' . htmlspecialchars($number, ENT_QUOTES, 'UTF-8') . '</h3><ul>';
            for ($i = 1; $i <= 12; $i++) {
                $tableResult .= '<li>' . $number . ' x ' . $i . ' = ' . ($number * $i) . '</li>';
            }
            $tableResult .= '</ul></div>';
        }
    } elseif ($_POST['action'] === 'sum') {
        $firstValue = $_POST['firstNumber'] ?? '';
        $secondValue = $_POST['secondNumber'] ?? '';
        $firstNumber = filter_var($firstValue, FILTER_VALIDATE_FLOAT);
        $secondNumber = filter_var($secondValue, FILTER_VALIDATE_FLOAT);
        if ($firstNumber === false || $secondNumber === false) {
            $sumResult = '<div class="result error">กรุณาป้อนตัวเลขทั้งสองช่องให้ถูกต้อง</div>';
        } else {
            $sum = $firstNumber + $secondNumber;
            $sumResult = '<div class="result"><h3>ผลบวก</h3><p>' . htmlspecialchars($firstNumber, ENT_QUOTES, 'UTF-8') . ' + ' . htmlspecialchars($secondNumber, ENT_QUOTES, 'UTF-8') . ' = ' . $sum . '</p></div>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Function Website</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f7fb; color: #333; margin: 0; padding: 20px; }
        .container { max-width: 800px; margin: auto; background: #ffffff; padding: 20px; border-radius: 12px; box-shadow: 0 4px 16px rgba(0,0,0,0.08); }
        h1 { margin-top: 0; }
        .grid { display: grid; gap: 24px; grid-template-columns: 1fr; }
        .card { background: #fafbff; border: 1px solid #d9e2ef; border-radius: 10px; padding: 18px; }
        label { display: block; margin-bottom: 8px; font-weight: bold; }
        input[type="number"] { width: 100%; padding: 10px; border: 1px solid #b3c2dd; border-radius: 6px; box-sizing: border-box; }
        button { margin-top: 12px; padding: 10px 18px; border: none; border-radius: 6px; background: #2563eb; color: #fff; cursor: pointer; }
        button:hover { background: #1d4ed8; }
        .result { background: #edf2ff; border: 1px solid #c7d2fe; border-radius: 8px; padding: 14px; margin-top: 16px; }
        .result.error { background: #ffe4e6; border-color: #fecdd3; }
        ul { padding-left: 20px; }
        p { margin: 0; }
    </style>
</head>
<body>
    <div class="container">
        <h1>PHP ฟังก์ชัน 2 อย่าง</h1>
        <p>เลือกใช้งานได้ทั้งสองฟังก์ชันด้านล่าง:</p>
        <div class="grid">
            <div class="card">
                <h2>1) ป้อนตัวเลขแล้วแสดงตารางสูตรคูณ</h2>
                <form method="post" action="">
                    <input type="hidden" name="action" value="table">
                    <label for="number">ตัวเลข:</label>
                    <input type="number" name="number" id="number" value="<?php echo htmlspecialchars($numberValue, ENT_QUOTES, 'UTF-8'); ?>" required>
                    <button type="submit">แสดงตารางสูตรคูณ</button>
                </form>
                <?php echo $tableResult; ?>
            </div>
            <div class="card">
                <h2>2) ป้อนตัวเลข 2 ตัว แล้วบวกกัน</h2>
                <form method="post" action="">
                    <input type="hidden" name="action" value="sum">
                    <label for="firstNumber">ตัวเลขที่ 1:</label>
                    <input type="number" step="any" name="firstNumber" id="firstNumber" value="<?php echo htmlspecialchars($firstValue, ENT_QUOTES, 'UTF-8'); ?>" required>
                    <label for="secondNumber">ตัวเลขที่ 2:</label>
                    <input type="number" step="any" name="secondNumber" id="secondNumber" value="<?php echo htmlspecialchars($secondValue, ENT_QUOTES, 'UTF-8'); ?>" required>
                    <button type="submit">คำนวณผลบวก</button>
                </form>
                <?php echo $sumResult; ?>
            </div>
        </div>
    </div>
</body>
</html>

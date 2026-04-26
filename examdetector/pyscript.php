<!-- <?php
// ✅ 1. Unquoted path for checking existence
$python_check_path = "C:\\Program Files\\Python314\\python.exe";

// ✅ 2. Quoted path for shell execution
$python = "\"$python_check_path\"";

// ✅ 3. Script and PDF file paths
$pythonscript = "C:\\pycharm\\extract.py";
$pdfpath = "C:\\pycharm\\PYTHON1.pdf";

// ✅ 4. Check that files actually exist (use unquoted path)
if (!file_exists($python_check_path)) die("❌ Python not found at: $python_check_path");
if (!file_exists($pythonscript)) die("❌ Script not found at: $pythonscript");
if (!file_exists($pdfpath)) die("❌ PDF not found at: $pdfpath");

// ✅ 5. Build shell command (quote script args properly)
$command = "$python " . escapeshellarg($pythonscript) . " " . escapeshellarg($pdfpath) . " 2>&1";

// ✅ 6. Execute and capture output
$output = shell_exec($command);

// ✅ 7. Display results
echo "<h2>PDF Analysis Results</h2>";
if ($output === null || trim($output) === '') {
    echo "<p style='color:red'>❌ No output or error from Python</p>";
} 
else {
    echo "<pre>" . htmlspecialchars($output) . "</pre>";
}

echo "hello";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PDF Analysis Result</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            max-width: 800px;
            margin: 60px auto;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #2c3e50;
        }
        .output {
            background-color: #f0f0f0;
            padding: 15px;
            border-radius: 8px;
            white-space: pre-wrap;
            font-family: Consolas, monospace;
            color: #333;
            max-height: 400px;
            overflow-y: auto;
        }
        .error {
            color: red;
            text-align: center;
        }
        footer {
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>📄 PDF Analysis Results</h2>
        <?php if ($output === null || trim($output) === ''): ?>
            <p class="error">❌ No output or error from Python</p>
        <?php else: ?>
            <div class="output"><?= htmlspecialchars($output); ?></div>
        <?php endif; ?>
    </div>

    <footer>
        &copy; <?= date("Y"); ?> - PHP + Python Integration Project
    </footer>
</body>
</html> -->
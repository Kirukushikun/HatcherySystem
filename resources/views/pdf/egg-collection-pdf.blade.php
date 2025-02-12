<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; font-size: 24px; font-weight: bold; }
        .content { margin-top: 20px; font-size: 18px; }
    </style>
</head>
<body>
    <div class="header">{{ $title }}</div>
    <p>Date: {{ $date }}</p>
    <div class="content">
        <p>{{ $content }}</p>
    </div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<style>
		body {
			background-color: #333;
			font-family: Arial, sans-serif;
			color: #fff;
			text-align: center;
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			height: 100vh;
		}.loading {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }
		.loader {
            border: 16px solid #f3f3f3; /* light grey */
            border-top: 16px solid #3498db; /* blue */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
		@keyframes spin {
			0% { transform: rotate(0deg); }
			100% { transform: rotate(360deg); }
		}
	</style>
</head>
<body>
    <div class="loading">
	    <h2>Currently No Check-In Data For This Session</h2>
    </div>
	<div class="loader"></div>
</body>
</html>

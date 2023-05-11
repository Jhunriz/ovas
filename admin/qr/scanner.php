<script src="html5-qrcode.min.js"></script>
<style>
    .result {
        color: black;
        padding: 20px;
        border-radius: 2px;
        background-color: gray;

    }

    .row {
        display: flex;
    }

    .container {
        display: flex;
        height: 60%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        padding: 20px;
        width: 45%;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border-radius: 5px;
        background-color: #fff;
    }



    .row {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .col {
        text-align: center;
    }

    .copybtn {
        width: 100%;
        background-color: lightblue;
        border: #f0f0f0;
        padding: 5px;

    }

    .bottom-button {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        padding-bottom: 20px;
        text-align: center;

    }

    .bot-btn {
        width: 90%;
        padding: 20px;
        border: none;
        background-color: lightblue;
        color: black;
        border-radius: 30px;
        transition: background-color 0.3s ease;
    }

    .bot-btn:hover {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        color: black;
    }

    body {
        background: linear-gradient(to bottom, lightblue, black);
    }
</style>


<div class="container">
    <div class="bottom-button">
        <a href="../index.php">
            <button class="bot-btn">Return</button>
        </a>
    </div>
    <div class="row">
        <div class="col">
            <div style="width:500px;" id="reader"></div>
        </div>
        <div class="col" style="padding:30px;">
            <h4>SCAN RESULT</h4>
            <div id="result">Result Here</div>
            <button class="copybtn" id="copyButton" onclick="copyText()"><svg xmlns="http://www.w3.org/2000/svg" style="height: 15px; width:15px;" class="" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>Copy</button>
        </div>
    </div>
</div>


<script type="text/javascript">
    function onScanSuccess(qrCodeMessage) {
        document.getElementById('result').innerHTML = '<span class="result">' + qrCodeMessage + '</span>';
    }

    function onScanError(errorMessage) {
        //handle scan error
    }

    function copyText() {
        var resultText = document.getElementById('result').innerText;
        navigator.clipboard.writeText(resultText)
            .then(function() {
                alert('Result copied to clipboard!');
            })
            .catch(function(error) {
                console.error('Unable to copy result: ', error);
            });
    }

    var html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", {
            fps: 10,
            qrbox: 250
        });
    html5QrcodeScanner.render(onScanSuccess, onScanError);
</script>
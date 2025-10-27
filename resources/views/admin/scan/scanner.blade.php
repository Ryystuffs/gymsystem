<x-navigation>
    <h1>QR Code Scanner</h1>


    <div class="flex flex-col justify-center items-center mt-8">

        <div id="qr-reader" class="w-[500px]"></div>
        <div id="qr-result"> <span href id="result"></span></div>

    </div>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <script>
        function onScanSuccess(decodedText, decodedResult) {
            document.getElementById("result").innerText = decodedText;

            console.log(decodedText);
            html5QrcodeScanner.clear().then(() => {
                console.log("QR scanner stopped after successful scan.");
            }).catch((error) => {
                console.error("Failed to stop scanning:", error);
            });
            fetch(decodedText)
                .then(res => res.json())
                .then(data => alert(data.message))
                .catch(err => console.error(err));
        }

        function onScanFailure(error) {
            console.warn(`Scan error: ${error}`);

        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", {
                fps: 10,
                qrbox: { width: 250, height: 250 },
            },
            false
        );

        html5QrcodeScanner.render(onScanSuccess, onScanFailure);

    </script>
</x-navigation>

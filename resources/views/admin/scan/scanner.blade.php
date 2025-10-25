<x-navigation>
    <h1>QR Code Scanner</h1>


    <div class="flex flex-col justify-center items-center mt-8">

        <div id="qr-reader" class="w-[500px]"></div>
        <div id="qr-result"> <a href id="result"></a></div>

    </div>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>


    <script>
        function onScanSuccess(decodedText, decodedResult) {
            document.getElementById("result").innerText = decodedText;

            console.log(decodedText);

            fetch(decodedText)
                .then(res => res.json())
                .then(data => alert(data.message))
                .catch(err => console.error(err));
        }

        function onScanFailure(error) {
            
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", {
                fps: 30
                , qrbox: 250
            },
            false
        );

        html5QrcodeScanner.render(onScanSuccess, onScanFailure);

    </script>
</x-navigation>

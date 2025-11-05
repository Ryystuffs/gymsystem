<x-navigation>
    <div class="min-h-screen bg-gray-50 flex flex-col items-center justify-center">

        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-gray-800 tracking-tight">QR Code Scanner</h1>
            <p class="text-gray-500 mt-2">Scan a QR code for Check-In and Check-Out</p>
        </div>

        <div class="bg-white shadow-lg rounded-2xl p-6 w-full max-w-md border border-gray-100">
            <div id="qr-reader" class="rounded-lg overflow-hidden border border-gray-200 shadow-inner"></div>

            <div id="qr-result" class="mt-6 text-center">
                <span class="text-sm text-gray-400">Scanned Result:</span>
                <div id="result" class="block mt-2 text-lg font-semibold text-blue-600 break-words max-w-full"></div>
            </div>
        </div>

        <div class="mt-10 text-gray-400 text-sm">
            <p>Ensure camera permission is granted for scanning.</p>
        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <script>
        function onScanSuccess(decodedText, decodedResult) {
            const resultElement = document.getElementById("result");
            console.log(decodedText);


            fetch(decodedText)
                .then(res => res.json())
                .then(data => {
                    console.log(data.message)
                    resultElement.innerText = data.message;
                })
                .catch(err => console.error(err));

            html5QrcodeScanner.clear().then(() => {
                console.log("QR scanner stopped after successful scan.");
                setTimeout(() => {
                        resultElement.innerText = "";
                        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
                    }, 3000)

                    
            }).catch((error) => {
                console.error("Failed to stop scanning:", error);
            });
    
        }

        function onScanFailure(error) {
            console.warn(`Scan error: ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", {
                fps: 10
                , qrbox: {
                    width: 250
                    , height: 250
                }
            , }
            , false
        );

        html5QrcodeScanner.render(onScanSuccess, onScanFailure);

    </script>
</x-navigation>

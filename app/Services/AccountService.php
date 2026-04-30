<?php
namespace App\Services;

use App\Models\User;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

    class AccountService {
        // Account related service methods can be added here in the future

        public function getAccounts(
            ?string $searchName = '',
            ?string $startDate = '',
            ?string $endDate = ''
        )
        {
            return User::when($searchName, function ($q) use ($searchName) {
                $q->where('name', 'LIKE', "%{$searchName}%");
            })
                ->when($startDate, function ($q) use ($startDate) {
                    $q->whereDate('created_at', '>=', $startDate);
                })
                ->when($endDate, function ($q) use ($endDate) {
                    $q->whereDate('created_at', '<=', $endDate);
                })
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        public function createAccount(array $data){
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'role' => 'member',
                'created_at' => now(),
            ]);

            $qrData = URL::signedRoute('admin.scan.qrScan', ['user' => $user->id]);
            $qrImage = QrCode::size(200)->format('png')->generate($qrData);
            $path = 'qrcodes/user_' . $user->id . '.png';
            Storage::disk('public')->put($path, $qrImage);
            $user->update(['qrcode' => $path]);
            return $user;
        }
    }
?>



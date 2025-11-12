<tbody>
@foreach($payments as $payment)
<tr class="text-center text-sm border-t border-gray-300">
    <td class="font-bold p-4">
        {{ $payment->user->name ?? $payment->walkinSession->name ?? 'N/A' }}
    </td>
    <td class="text-[#2d2eb4]">
        {{ $payment->amount ?? $payment->walkinSession->amount_paid ?? '0' }}
    </td>
    <td>{{ $payment->payment_method ?? 'N/A' }}</td>
    <td>{{ $payment->type ?? 'N/A' }}</td>
    <td>{{ $payment->created_at }}</td>
    <td>{{ $payment->membershipPlan->name ?? 'Not a Member' }}</td>
</tr>
@endforeach
</tbody>

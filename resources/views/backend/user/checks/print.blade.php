<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Check #{{ $check->check_number }}</title>
    @vite('resources/css/app.css')

    <style>
        /* ===== No margins/padding anywhere ===== */
        @page { margin: 0; }
        body { margin: 0;  font-family: Arial, sans-serif; }

        /* ===== MICR Font ===== */
        @font-face {
            font-family: 'MICR';
            src: url('/fonts/micr.ttf') format('truetype');
        }

        /* ===== MICR Line and Clear Band ===== */
        .micr-line {
            font-family: 'MICR', monospace;
            font-size: 0.9rem;        /* smaller than 1.2rem (~12pt) */
            letter-spacing: 0.01in;   /* maintain 1/8" spacing */
            white-space: nowrap;
            position: absolute;
            bottom: 0.1in;           /* adjust vertical position */
            left: 50%;                /* center horizontally */
            transform: translateX(-50%); /* true horizontal centering */
            text-align: center;
        }

        .micr-line span.check-number {
            opacity: 0.7 !important;
        }


        /* Signature line */
        .signature-line {
            border-top: 1px solid black;
            width: 1.75in;
            text-align: center;
            font-size: 0.55rem;
            text-transform: uppercase;
        }

        /* Print adjustments */
        @media print {
            body { margin: 0; background: #fff; }
            .page { border: none; box-shadow: none;  }
        }
    </style>
</head>

<body class="bg-white p-7">

<div class="page relative w-[8.25in] h-[3.5in] border border-gray-800 pr-8">
    
    <!-- HEADER -->
    <div class="flex justify-between items-start p-2">
        <div class="font-bold text-lg pl-2">ישיבת ריבניצא</div>
        <div class="text-center font-semibold text-sm">NORTHEAST COMMUNITY BANK</div>
        <div class="text-right font-semibold text-sm">{{ $check->check_number }}</div>
    </div>

    <!-- DATE -->
    <div class="flex justify-end items-baseline px-2">
        <span class="font-bold text-xs mr-1">DATE:</span>
        <span class="text-xs">{{ $check->created_at->format('M d, Y') }}</span>
    </div>

  
    <!-- PAYEE + AMOUNT BOX ON SAME LINE -->
    <div class="flex justify-between items-end px-4 pt-7 mt-2">

        <!-- PAYEE -->
        <div class="flex-1 flex flex-col text-xs font-bold leading-none">
            <span>PAY TO</span>
            <span>THE</span>
            <div class="flex items-center">
                <span>ORDER OF</span>
                <!-- Border + company name -->
                <span class="border-b border-black flex-1 h-6 ml-2 flex items-center text-sm px-1">
                    {{ $check->company->name }}
                </span>
            </div>
        </div>

        <!-- AMOUNT BOX -->
        <div class="border border-black w-32 h-6 flex items-center justify-center text-sm ml-4">
            ${{ number_format($check->amount, 2) }}
        </div>

    </div>


    <!-- AMOUNT IN WORDS -->
    <div class="mt-2 px-4">
        <div class="border-b border-black mt-1 h-6 w-full text-sm">
            {{ $check->amount_in_words }}
        </div>
    </div>

    <!-- SIGNATURE -->
    <div class="flex justify-end mt-8 px-8 pt-7">
        <div class="signature-line">Authorized Signature</div>
    </div>

    <!-- MICR LINE -->
    <!-- <div class="micr-line">
        MICR: ⑇ check ⑇  ⑆ routing ⑆ ⑈ account ⑈
          U{{ $check->check_number }}U T226072511T U0250435021U
    </div> -->

    <!-- MICR LINE -->
    <div class="micr-line" style="display: flex; align-items: center; justify-content: center; gap: 6px;">
        <!-- Dynamic MICR check number -->
        <span style="font-family: 'MICR'; font-size: 0.9rem; letter-spacing: 0.01in;" class="check-number">
            ⑈{{ $check->check_number }}
        </span>

        <!-- Static routing + account MICR image -->
        <img src="/assets/IMG-20251121-WA0015 (2).jpg"
            alt="MICR routing and account"
            style="height: 0.35in; object-fit: contain;" class="mt-1" />
    </div>
    


</div>

<script>
    window.onload = () => window.print();
</script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi BUMDes</title>
    <style>
        table {
            border-collapse: collapse;
            }
        
            th, td {
            padding: 5px;
            }
    </style>
</head>
<body>
<center>
    <br>
<table width="800" border="0">
    <tr>
        <td align="left"><b style="font-size:20px;">NOTA SERVICE ELEKTRONIK</b><br> Jl. Yai Ageng Arem-Arem 9B/No.1 <br> Telp. 08123456789</td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td align="right" colspan="2"><hr></td>
    </tr>
</table>
    <table width="800" border="0">
        <tr>
            <td>Nama Konsumen : {{$nota->nama_konsumen}} </td>
            <td></td>
            <td>
                {{-- {{date('d F Y', strtotime($start))}} --}}
            </td>
        </tr>
        <tr>
            <td>Nama Barang : {{$nota->nama_barang}}</td>
            <td></td>
            <td>
                {{-- {{date('d F Y', strtotime($start))}} --}}
            </td>
        </tr>
        <tr>
            <td>No. Seri Barang : {{$nota->nomor_seri}}</td>
            <td></td>
            <td>
                {{-- {{date('d F Y', strtotime($start))}} --}}
            </td>
        </tr>
        <tr>
            <td>Tipe Barang : {{$nota->tipe}}</td>
            <td></td>
            <td>
                {{-- {{date('d F Y', strtotime($start))}} --}}
            </td>
        </tr>
        <tr>
            <td>Harga Service : @currency2($nota->harga_pengerjaan)</td>
            <td></td>
            <td>
                {{-- {{date('d F Y', strtotime($start))}} --}}
            </td>
        </tr>
    </table><br>
    <table algin="right" width="800" border="0">
        <tr>
           
            <td width="300"></td>
            <td width="300"></td>
            <td>{{date('d F Y', strtotime(now()))}}</td>
        </tr>
    </table>
    </center>
    <script type="text/javascript">
 window.print();
</script>
</body>
</html>
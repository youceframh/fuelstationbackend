<head>
    <meta charset="UTF-8" />
    <title>Facture José Roux</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300|Raleway:200,300" rel="stylesheet" type="text/css" />
    <style>
    /*** @media all  ***/
* {
  box-sizing: border-box;
}
html {
  height: 100%;
}
body {
  min-height: 100%;
  margin: 0;
  display: flex;
  flex-flow: column nowrap;
  justify-content: center;
  align-items: stretch;
  font: 12pt/1.5 'Raleway', 'Cambria', sans-serif;
  font-weight: 300;
  background: #fff;
  color: #666;
  -webkit-print-color-adjust: exact;
}
header {
  padding: 16px;
  position: relative;
  color: #888;
}
header h1,
header h2 {
  font-weight: 200;
  margin: 0;
}
header h1 {
  font-size: 27pt;
  letter-spacing: 4px;
}
body > * {
  width: 100%;
  max-width: 7in;
  margin: 3px auto;
  background: #f0f0f0;
  text-align: center;
}
footer {
  padding: 16px;
}
footer p {
  font-size: 9pt;
  margin: 0;
  font-family: 'Nunito';
  color: #777;
}
section,
table {
  padding: 8px 0;
  position: relative;
}
dl {
  margin: 0;
  letter-spacing: -4px;
}
dl dt,
dl dd {
  letter-spacing: normal;
  display: inline-block;
  margin: 0;
  padding: 0px 6px;
  vertical-align: top;
}
dl.bloc > dt,
dl:not(.bloc) dt:not(:last-of-type),
dl:not(.bloc) dd:not(:last-of-type) {
  border-bottom: 1px solid #ddd;
}
dl:not(.bloc) dt {
  border-right: 1px solid #ddd;
}
dt {
  width: 49%;
  text-align: right;
  letter-spacing: 1px !important;
  overflow: hidden;
}
dd {
  width: 49%;
  text-align: left;
}
dd,
tr>td {
  font-family: 'Nunito';
}
section.flex {
  display: flex;
  flex-flow: row wrap;
  padding: 8px 16px;
  justify-content: space-around;
}
dl.bloc {
  padding: 0;
  flex: 1;
  vertical-align: top;
  min-width: 240px;
  margin: 0 8px 8px;
}
dl.bloc>dt {
  text-align: left;
  width: 100%;
  margin-top: 12px;
}
dl.bloc>dd {
  text-align: left;
  width: 100%;
  padding: 8px 0 5px 16px;
  line-height: 1.25;
}
dl.bloc>dd>dl dt {
  width: 33%;
}
dl.bloc>dd>dl dd {
  width: 60%;
}
dl.bloc dl {
  margin-top: 12px;
}
dl.bloc dd {
  font-size: 11pt;
}
table {
  width: 100%;
  padding: 0;
  border-spacing: 0px;
}
table tr {
  margin: 0;
  padding: 0;
  background: #fdfdfd;
  border-right: 1px solid #ddd;
  width: 100%;
}
table tr td,
table tr th {
  border: 1px solid #e3e3e3;
  border-top: 1px solid #fff;
  border-left-color: #fff;
  font-size: 11pt;
  background: #fdfdfd;
}
table thead th {
  background: #e9e9e9;
  background: linear-gradient(to bottom, #f9f9f9, #e9e9e9) !important;
  font-weight: 300;
  letter-spacing: 1px;
  padding: 15px 0 5px;
/*&:not(:last-child)*/
  border: none !important;
}
table tbody tr:last-child td {
  border-bottom: 1px solid #ddd;
}
table tbody td {
  min-width: 75px;
  padding: 3px 6px;
  line-height: 1.25;
}
table tfoot tr td {
/*border 1px solid #e3e3e3
      border-top 1px solid white
      border-left-color #fff*/
  height: 40px;
  padding: 6px 0 0;
  color: #000;
  text-shadow: 0 0 1px rgba(0,0,0,0.25);
  font-family: 'Cambria', 'Raleway', sans-serif;
  font-weight: 400;
  letter-spacing: 1px;
}
table tfoot tr td:first-child {
  font-style: italic;
  color: #997b7b;
}
a {
  color: #992c2c;
}
a:hover {
  color: #b00;
}
@page {
  margin: 0.5cm;
}
/*** @media screen  ***/
html,
body {
  background: #333231;
}
header:before {
  content: '';
  position: absolute;
  top: 0;
  right: 0;
  border-top: 12px solid #333;
  border-left: 12px solid #ddd;
  width: 0;
  box-shadow: 1px 1px 2px rgba(0,0,0,0.18);
}

    </style>
</head>
@php

$billnbr = $facture->inovice_number;
$dateofbill = $facture->date_of_last_addition;
$annex_id = $facture->annex_id;
$annex_name = DB::table('annexes')->where('idannexes',$annex_id)->first()->name;
$total = $facture->amount_spend;
$aramco = $facture->aramco_number;


@endphp
<body>
    <header>
        <h1>فاتورة</h1>
        <h2>فاتورة تسجيل بترول</h2>
    </header>
    <section class="flex">
        <dl>
            <dt>{{$billnbr}}</dt>
            <dd>فاتورة رقم #</dd>
            <dt>{{$dateofbill}}</dt>
            <dd>تاريخ الفاتورة</dd>
        </dl>
    </section>
    <section class="flex">
        <dl class="bloc" style="text-align-last: start;direction: rtl;">
            <dt>فاتورة خاصة بلفرع</dt>
            <dd>{{$annex_name}}</dd>
        </dl>
        <dl class="bloc" style="text-align-last: start;direction: rtl;">
            <dt>وصف الخدمة</dt>
            <dd>ملا خزانات وقود</dd>
        </dl>
    </section>
    <table>
        <thead>
            <tr>
                <th>التاريخ</th>
                <th>الوصف</th>
                <th>رقم ارامكو</th>
                <th>المجموع</th>
                <th>الاجمالي</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$dateofbill}}</td>
                <td>Dévelopement du jeu Tomatina</td>
                <td>{{$aramco}}</td>
                <td>{{$total}}</td>
                <td>{{$total}}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">المبلغ المدفوع</td>
                <td>الاجمالي:</td>
                <td>{{$total}} ريال</td>
            </tr>
        </tfoot>
    </table>
</body>
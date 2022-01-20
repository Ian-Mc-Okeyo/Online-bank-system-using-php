<?php
    error_reporting(E_ALL);
    $result=$from=$from_c_name=$to_c_name=$from_c_code=$to_c_code=$time='';
    if(isset($_POST['Convert'])){
        try{
                $from_c = $_POST['from_c'];
                $to_c = $_POST['to_c'];
                $API_KEY= "61N7X1H7ILJI7SDI";
                $data = file_get_contents("https://www.alphavantage.co/query?function=CURRENCY_EXCHANGE_RATE&from_currency=$from_c&to_currency=$to_c&apikey=$API_KEY");
                $d = json_decode($data, true);
                $rate = $d['Realtime Currency Exchange Rate']['5. Exchange Rate'];
                $result=$_POST['amount']*$rate;
                $from = $_POST['amount'];
                $time = $d['Realtime Currency Exchange Rate']['6. Last Refreshed'];
                $from_c_code = $d['Realtime Currency Exchange Rate']['1. From_Currency Code'];
                $from_c_name = $d['Realtime Currency Exchange Rate']['2. From_Currency Name'];
                $to_c_code = $d['Realtime Currency Exchange Rate']['3. To_Currency Code'];
                $to_c_name = $d['Realtime Currency Exchange Rate']['4. To_Currency Name'];
        }
        catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
            echo 'ERROR';
          }
    }

?>
<DOCTYPE html>
<html>
    <?php include "header.php"?>
    <br>
        <br>
        <br>
        <form action="forex.php" method="POST", class="forex-page">
            <div><h2 style="color:lawngreen">From:</h2></div>
            <div>
                <input type="number"  name="amount" placeholder="Enter Amount" class="actions-forms" required='required' min="0" value="<?php echo $from ?>">
                <select name='from_c' class="forex-form">
                <?php if($from_c_name !=''){?>
                    <option value=<?php echo $from_c_code?> selected><?php echo $from_c_name ?></option>
                <?php }?>
                    <option value="AED">United Arab Emirates Dirham</option>
                    <option value="AFN">Afghan Afghani</option>
                    <option value="ALL">Albanian Lek</option>
                    <option value="AMD">Armenian Dram</option>
                    <option value="ANG">Netherlands Antillean Guilder</option>
                    <option value="AOA">Angolan Kwanza</option>
                    <option value="ARS">Argentine Peso</option>
                    <option value="AUD">Australian Dollar</option>
                    <option value="AWG">Aruban Florin</option>
                    <option value="AZN">Azerbaijani Manat</option>
                    <option value="BAM">Bosnia-Herzegovina Convertible Mark</option>
                    <option value="BBD">Barbadian Dollar</option>
                    <option value="BDT">Bangladeshi Taka</option>
                    <option value="BGN">Bulgarian Lev</option>
                    <option value="BHD">Bahraini Dinar</option>
                    <option value="BIF">Burundian Franc</option>
                    <option value="BMD">Bermudan Dollar</option>
                    <option value="BND">Brunei Dollar</option>
                    <option value="BOB">Bolivian Boliviano</option>
                    <option value="BRL">Brazilian Real</option>
                    <option value="BSD">Bahamian Dollar</option>
                    <option value="BTN">Bhutanese Ngultrum</option>
                    <option value="BWP">Botswanan Pula</option>
                    <option value="BZD">Belize Dollar</option>
                    <option value="CAD">Canadian Dollar</option>
                    <option value="CDF">Congolese Franc</option>
                    <option value="CHF">Swiss Franc</option>
                    <option value="CLF">Chilean Unit of Account UF</option>
                    <option value="CLP">Chilean Peso</option>
                    <option value="CNH">Chinese Yuan Offshore</option>
                    <option value="CNY">Chinese Yuan</option>
                    <option value="COP">Colombian Peso</option>
                    <option value="CUP">Cuban Peso</option>
                    <option value="CVE">Cape Verdean Escudo</option>
                    <option value="CZK">Czech Republic Koruna</option>
                    <option value="DJF">Djiboutian Franc</option>
                    <option value="DKK">Danish Krone</option>
                    <option value="DOP">Dominican Peso</option>
                    <option value="DZD">Algerian Dinar</option>
                    <option value="EGP">Egyptian Pound</option>
                    <option value="ERN">Eritrean Nakfa</option>
                    <option value="ETB">Ethiopian Birr</option>
                    <option value="EUR">Euro</option>
                    <option value="FJD">Fijian Dollar</option>
                    <option value="FKP">Falkland Islands Pound</option>
                    <option value="GBP">British Pound Sterling</option>
                    <option value="GEL">Georgian Lari</option>
                    <option value="GHS">Ghanaian Cedi</option>
                    <option value="GIP">Gibraltar Pound</option>
                    <option value="GMD">Gambian Dalasi</option>
                    <option value="GNF">Guinean Franc</option>
                    <option value="GTQ">Guatemalan Quetzal</option>
                    <option value="GYD">Guyanaese Dollar</option>
                    <option value="HKD">Hong Kong Dollar</option>
                    <option value="HNL">Honduran Lempira</option>
                    <option value="HRK">Croatian Kuna</option>
                    <option value="HTG">Haitian Gourde</option>
                    <option value="HUF">Hungarian Forint</option>
                    <option value="IDR">Indonesian Rupiah</option>
                    <option value="ILS">Israeli New Sheqel</option>
                    <option value="INR">Indian Rupee</option>
                    <option value="IQD">Iraqi Dinar</option>
                    <option value="IRR">Iranian Rial</option>
                    <option value="ISK">Icelandic Krona</option>
                    <option value="JEP">Jersey Pound</option>
                    <option value="JMD">Jamaican Dollar</option>
                    <option value="JOD">Jordanian Dinar</option>
                    <option value="JPY">Japanese Yen</option>
                    <option value="KES">Kenyan Shilling</option>
                    <option value="KGS">Kyrgystani Som</option>
                    <option value="KHR">Cambodian Riel</option>
                    <option value="KMF">Comorian Franc</option>
                    <option value="KPW">North Korean Won</option>
                    <option value="KRW">South Korean Won</option>
                    <option value="KWD">Kuwaiti Dinar</option>
                    <option value="KYD">Cayman Islands Dollar</option>
                    <option value="KZT">Kazakhstani Tenge</option>
                    <option value="LAK">Laotian Kip</option>
                    <option value="LBP">Lebanese Pound</option>
                    <option value="LKR">Sri Lankan Rupee</option>
                    <option value="LRD">Liberian Dollar</option>
                    <option value="LSL">Lesotho Loti</option>
                    <option value="LYD">Libyan Dinar</option>
                    <option value="MAD">Moroccan Dirham</option>
                    <option value="MDL">Moldovan Leu</option>
                    <option value="MGA">Malagasy Ariary</option>
                    <option value="MKD">Macedonian Denar</option>
                    <option value="MMK">Myanma Kyat</option>
                    <option value="MNT">Mongolian Tugrik</option>
                    <option value="MOP">Macanese Pataca</option>
                    <option value="MRO">Mauritanian Ouguiya (pre-2018)</option>
                    <option value="MRU">Mauritanian Ouguiya</option>
                    <option value="MUR">Mauritian Rupee</option>
                    <option value="MVR">Maldivian Rufiyaa</option>
                    <option value="MWK">Malawian Kwacha</option>
                    <option value="MXN">Mexican Peso</option>
                    <option value="MYR">Malaysian Ringgit</option>
                    <option value="MZN">Mozambican Metical</option>
                    <option value="NAD">Namibian Dollar</option>
                    <option value="NGN">Nigerian Naira</option>
                    <option value="NOK">Norwegian Krone</option>
                    <option value="NPR">Nepalese Rupee</option>
                    <option value="NZD">New Zealand Dollar</option>
                    <option value="OMR">Omani Rial</option>
                    <option value="PAB">Panamanian Balboa</option>
                    <option value="PEN">Peruvian Nuevo Sol</option>
                    <option value="PGK">Papua New Guinean Kina</option>
                    <option value="PHP">Philippine Peso</option>
                    <option value="PKR">Pakistani Rupee</option>
                    <option value="PLN">Polish Zloty</option>
                    <option value="PYG">Paraguayan Guarani</option>
                    <option value="QAR">Qatari Rial</option>
                    <option value="RON">Romanian Leu</option>
                    <option value="RSD">Serbian Dinar</option>
                    <option value="RUB">Russian Ruble</option>
                    <option value="RUR">Old Russian Ruble</option>
                    <option value="RWF">Rwandan Franc</option>
                    <option value="SAR">Saudi Riyal</option>
                    <option value="SBDf">Solomon Islands Dollar</option>
                    <option value="SCR">Seychellois Rupee</option>
                    <option value="SDG">Sudanese Pound</option>
                    <option value="SDR">Special Drawing Rights</option>
                    <option value="SEK">Swedish Krona</option>
                    <option value="SGD">Singapore Dollar</option>
                    <option value="SHP">Saint Helena Pound</option>
                    <option value="SLL">Sierra Leonean Leone</option>
                    <option value="SOS">Somali Shilling</option>
                    <option value="SRD">Surinamese Dollar</option>
                    <option value="SYP">Syrian Pound</option>
                    <option value="SZL">Swazi Lilangeni</option>
                    <option value="THB">Thai Baht</option>
                    <option value="TJS">Tajikistani Somoni</option>
                    <option value="TMT">Turkmenistani Manat</option>
                    <option value="TND">Tunisian Dinar</option>
                    <option value="TOP">Tongan Pa'anga</option>
                    <option value="TRY">Turkish Lira</option>
                    <option value="TTD">Trinidad and Tobago Dollar</option>
                    <option value="TWD">New Taiwan Dollar</option>
                    <option value="TZS">Tanzanian Shilling</option>
                    <option value="UAH">Ukrainian Hryvnia</option>
                    <option value="UGX">Ugandan Shilling</option>
                    <option value="USD">United States Dollar</option>
                    <option value="UYU">Uruguayan Peso</option>
                    <option value="UZS">Uzbekistan Som</option>
                    <option value="VND">Vietnamese Dong</option>
                    <option value="VUV">Vanuatu Vatu</option>
                    <option value="WST">Samoan Tala</option>
                    <option value="XAF">CFA Franc BEAC</option>
                    <option value="XCD">East Caribbean Dollar</option>
                    <option value="XDR">Special Drawing Rights</option>
                    <option value="XOF">CFA Franc BCEAO</option>
                    <option value="XPF">CFP Franc</option>
                    <option value="YER">Yemeni Rial</option>
                    <option value="ZAR">South African Rand</option>
                    <option value="ZMW">Zambian Kwacha</option>
                    <option value="ZWL">Zimbabwean Dollar</option>
            </select>
            </div>
            <br>
            <di><h2 style="color: lawngreen">To:</h2></di>
            <div>
                <input type="number" placeholder="Result" class="actions-forms" readonly value = <?php echo $result ?>>
            <select name='to_c' class="forex-form">
                <option>Choose Currency</option>
                <?php if($to_c_name !=''){?>
                    <option value=<?php echo $to_c_code?> selected><?php echo $to_c_name ?></option>
                <?php }?>
                    <option value="AED">United Arab Emirates Dirham</option>
                    <option value="AFN">Afghan Afghani</option>
                    <option value="ALL">Albanian Lek</option>
                    <option value="AMD">Armenian Dram</option>
                    <option value="ANG">Netherlands Antillean Guilder</option>
                    <option value="AOA">Angolan Kwanza</option>
                    <option value="ARS">Argentine Peso</option>
                    <option value="AUD">Australian Dollar</option>
                    <option value="AWG">Aruban Florin</option>
                    <option value="AZN">Azerbaijani Manat</option>
                    <option value="BAM">Bosnia-Herzegovina Convertible Mark</option>
                    <option value="BBD">Barbadian Dollar</option>
                    <option value="BDT">Bangladeshi Taka</option>
                    <option value="BGN">Bulgarian Lev</option>
                    <option value="BHD">Bahraini Dinar</option>
                    <option value="BIF">Burundian Franc</option>
                    <option value="BMD">Bermudan Dollar</option>
                    <option value="BND">Brunei Dollar</option>
                    <option value="BOB">Bolivian Boliviano</option>
                    <option value="BRL">Brazilian Real</option>
                    <option value="BSD">Bahamian Dollar</option>
                    <option value="BTN">Bhutanese Ngultrum</option>
                    <option value="BWP">Botswanan Pula</option>
                    <option value="BZD">Belize Dollar</option>
                    <option value="CAD">Canadian Dollar</option>
                    <option value="CDF">Congolese Franc</option>
                    <option value="CHF">Swiss Franc</option>
                    <option value="CLF">Chilean Unit of Account UF</option>
                    <option value="CLP">Chilean Peso</option>
                    <option value="CNH">Chinese Yuan Offshore</option>
                    <option value="CNY">Chinese Yuan</option>
                    <option value="COP">Colombian Peso</option>
                    <option value="CUP">Cuban Peso</option>
                    <option value="CVE">Cape Verdean Escudo</option>
                    <option value="CZK">Czech Republic Koruna</option>
                    <option value="DJF">Djiboutian Franc</option>
                    <option value="DKK">Danish Krone</option>
                    <option value="DOP">Dominican Peso</option>
                    <option value="DZD">Algerian Dinar</option>
                    <option value="EGP">Egyptian Pound</option>
                    <option value="ERN">Eritrean Nakfa</option>
                    <option value="ETB">Ethiopian Birr</option>
                    <option value="EUR">Euro</option>
                    <option value="FJD">Fijian Dollar</option>
                    <option value="FKP">Falkland Islands Pound</option>
                    <option value="GBP">British Pound Sterling</option>
                    <option value="GEL">Georgian Lari</option>
                    <option value="GHS">Ghanaian Cedi</option>
                    <option value="GIP">Gibraltar Pound</option>
                    <option value="GMD">Gambian Dalasi</option>
                    <option value="GNF">Guinean Franc</option>
                    <option value="GTQ">Guatemalan Quetzal</option>
                    <option value="GYD">Guyanaese Dollar</option>
                    <option value="HKD">Hong Kong Dollar</option>
                    <option value="HNL">Honduran Lempira</option>
                    <option value="HRK">Croatian Kuna</option>
                    <option value="HTG">Haitian Gourde</option>
                    <option value="HUF">Hungarian Forint</option>
                    <option value="IDR">Indonesian Rupiah</option>
                    <option value="ILS">Israeli New Sheqel</option>
                    <option value="INR">Indian Rupee</option>
                    <option value="IQD">Iraqi Dinar</option>
                    <option value="IRR">Iranian Rial</option>
                    <option value="ISK">Icelandic Krona</option>
                    <option value="JEP">Jersey Pound</option>
                    <option value="JMD">Jamaican Dollar</option>
                    <option value="JOD">Jordanian Dinar</option>
                    <option value="JPY">Japanese Yen</option>
                    <option value="KES">Kenyan Shilling</option>
                    <option value="KGS">Kyrgystani Som</option>
                    <option value="KHR">Cambodian Riel</option>
                    <option value="KMF">Comorian Franc</option>
                    <option value="KPW">North Korean Won</option>
                    <option value="KRW">South Korean Won</option>
                    <option value="KWD">Kuwaiti Dinar</option>
                    <option value="KYD">Cayman Islands Dollar</option>
                    <option value="KZT">Kazakhstani Tenge</option>
                    <option value="LAK">Laotian Kip</option>
                    <option value="LBP">Lebanese Pound</option>
                    <option value="LKR">Sri Lankan Rupee</option>
                    <option value="LRD">Liberian Dollar</option>
                    <option value="LSL">Lesotho Loti</option>
                    <option value="LYD">Libyan Dinar</option>
                    <option value="MAD">Moroccan Dirham</option>
                    <option value="MDL">Moldovan Leu</option>
                    <option value="MGA">Malagasy Ariary</option>
                    <option value="MKD">Macedonian Denar</option>
                    <option value="MMK">Myanma Kyat</option>
                    <option value="MNT">Mongolian Tugrik</option>
                    <option value="MOP">Macanese Pataca</option>
                    <option value="MRO">Mauritanian Ouguiya (pre-2018)</option>
                    <option value="MRU">Mauritanian Ouguiya</option>
                    <option value="MUR">Mauritian Rupee</option>
                    <option value="MVR">Maldivian Rufiyaa</option>
                    <option value="MWK">Malawian Kwacha</option>
                    <option value="MXN">Mexican Peso</option>
                    <option value="MYR">Malaysian Ringgit</option>
                    <option value="MZN">Mozambican Metical</option>
                    <option value="NAD">Namibian Dollar</option>
                    <option value="NGN">Nigerian Naira</option>
                    <option value="NOK">Norwegian Krone</option>
                    <option value="NPR">Nepalese Rupee</option>
                    <option value="NZD">New Zealand Dollar</option>
                    <option value="OMR">Omani Rial</option>
                    <option value="PAB">Panamanian Balboa</option>
                    <option value="PEN">Peruvian Nuevo Sol</option>
                    <option value="PGK">Papua New Guinean Kina</option>
                    <option value="PHP">Philippine Peso</option>
                    <option value="PKR">Pakistani Rupee</option>
                    <option value="PLN">Polish Zloty</option>
                    <option value="PYG">Paraguayan Guarani</option>
                    <option value="QAR">Qatari Rial</option>
                    <option value="RON">Romanian Leu</option>
                    <option value="RSD">Serbian Dinar</option>
                    <option value="RUB">Russian Ruble</option>
                    <option value="RUR">Old Russian Ruble</option>
                    <option value="RWF">Rwandan Franc</option>
                    <option value="SAR">Saudi Riyal</option>
                    <option value="SBDf">Solomon Islands Dollar</option>
                    <option value="SCR">Seychellois Rupee</option>
                    <option value="SDG">Sudanese Pound</option>
                    <option value="SDR">Special Drawing Rights</option>
                    <option value="SEK">Swedish Krona</option>
                    <option value="SGD">Singapore Dollar</option>
                    <option value="SHP">Saint Helena Pound</option>
                    <option value="SLL">Sierra Leonean Leone</option>
                    <option value="SOS">Somali Shilling</option>
                    <option value="SRD">Surinamese Dollar</option>
                    <option value="SYP">Syrian Pound</option>
                    <option value="SZL">Swazi Lilangeni</option>
                    <option value="THB">Thai Baht</option>
                    <option value="TJS">Tajikistani Somoni</option>
                    <option value="TMT">Turkmenistani Manat</option>
                    <option value="TND">Tunisian Dinar</option>
                    <option value="TOP">Tongan Pa'anga</option>
                    <option value="TRY">Turkish Lira</option>
                    <option value="TTD">Trinidad and Tobago Dollar</option>
                    <option value="TWD">New Taiwan Dollar</option>
                    <option value="TZS">Tanzanian Shilling</option>
                    <option value="UAH">Ukrainian Hryvnia</option>
                    <option value="UGX">Ugandan Shilling</option>
                    <option value="USD">United States Dollar</option>
                    <option value="UYU">Uruguayan Peso</option>
                    <option value="UZS">Uzbekistan Som</option>
                    <option value="VND">Vietnamese Dong</option>
                    <option value="VUV">Vanuatu Vatu</option>
                    <option value="WST">Samoan Tala</option>
                    <option value="XAF">CFA Franc BEAC</option>
                    <option value="XCD">East Caribbean Dollar</option>
                    <option value="XDR">Special Drawing Rights</option>
                    <option value="XOF">CFA Franc BCEAO</option>
                    <option value="XPF">CFP Franc</option>
                    <option value="YER">Yemeni Rial</option>
                    <option value="ZAR">South African Rand</option>
                    <option value="ZMW">Zambian Kwacha</option>
                    <option value="ZWL">Zimbabwean Dollar</option>
            </select>
            </div>
            
            <div><input type="submit" name="Convert" value="Convert" class="actions-submit"></div>
            <?php if($time !=''){?>
                <h4 style="color: red; text-align: center;">** Last Update on <?php echo $time ?> UTC</h4>
            <?php }?>
        </form> 
</body>
</html>
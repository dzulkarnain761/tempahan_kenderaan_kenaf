<!DOCTYPE html>
<html>
<head>
    <title>Borang Laporan Pemeriksaan Traktor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-container {
            max-width: 1000px;
            width: 100%;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            text-align: center;
            border: 1px solid #ddd;
            padding: 12px;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        td {
            background-color: #fafafa;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

       textarea {
			width: 350px; 
			height: 70px; 
			resize: vertical; 
}

        input[type="radio"] {
            margin-right: 5px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .textarea-wrapper {
            position: relative;
            display: flex;
            justify-content: center;
        }

        .textarea-wrapper textarea {
            width: 100%;
        }

    </style>
</head>
<body>

<div class="form-container">
    <h2>Borang Laporan Pemeriksaan Penyerahan dan Pemulangan Traktor</h2>

    <form action="#" method="post">
        <table>
            <tr>
                <th>Bil</th>
                <th>Perkara</th>
                <th>Keadaan Semasa Penyerahan</th>
                <th>Keadaan Semasa Pemulangan</th>
                <th>Ulasan Mekanik</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Minyak Enjin</td>
                <td>
                    <input type="radio" name="penyerahan_minyak_enjin" value="baik"> Baik
                    <input type="radio" name="penyerahan_minyak_enjin" value="rosak"> Rosak
                </td>
                <td>
                    <input type="radio" name="pemulangan_minyak_enjin" value="baik"> Baik
                    <input type="radio" name="pemulangan_minyak_enjin" value="rosak"> Rosak
                </td>
                <td class="textarea-wrapper">
                    <textarea name="ulasan_minyak_enjin" rows="4"></textarea>
                </td>
            </tr>

                <td>2</td>
                <td>Minyak Steering</td>
                <td>
                    <input type="radio" name="penyerahan_minyak_enjin" value="baik"> Baik
                    <input type="radio" name="penyerahan_minyak_enjin" value="rosak"> Rosak
                </td>
                <td>
                    <input type="radio" name="pemulangan_minyak_enjin" value="baik"> Baik
                    <input type="radio" name="pemulangan_minyak_enjin" value="rosak"> Rosak
                </td>
                <td>
                    <textarea name="ulasan_minyak_enjin" rows="4"></textarea>
                </td>
            </tr>
		   
			<tr>
                <td>3</td>
                <td>Minyak Hidraulik</td>
                <td>
                    <input type="radio" name="penyerahan_minyak_enjin" value="baik"> Baik
                    <input type="radio" name="penyerahan_minyak_enjin" value="rosak"> Rosak
                </td>
                <td>
                    <input type="radio" name="pemulangan_minyak_enjin" value="baik"> Baik
                    <input type="radio" name="pemulangan_minyak_enjin" value="rosak"> Rosak
                </td>
                <td>
                    <textarea name="ulasan_minyak_enjin" rows="4"></textarea>
                </td>
            </tr>
		   
			<tr>
                <td>4</td>
                <td>Minyak brek</td>
                <td>
                    <input type="radio" name="penyerahan_minyak_enjin" value="baik"> Baik
                    <input type="radio" name="penyerahan_minyak_enjin" value="rosak"> Rosak
                </td>
                <td>
                    <input type="radio" name="pemulangan_minyak_enjin" value="baik"> Baik
                    <input type="radio" name="pemulangan_minyak_enjin" value="rosak"> Rosak
                </td>
                <td>
                    <textarea name="ulasan_minyak_enjin" rows="4"></textarea>
                </td>
            </tr>
		   
		   <tr>
                <td>5</td>
                <td>Air Radiator</td>
                <td>
                    <input type="radio" name="penyerahan_minyak_enjin" value="baik"> Baik
                    <input type="radio" name="penyerahan_minyak_enjin" value="rosak"> Rosak
                </td>
                <td>
                    <input type="radio" name="pemulangan_minyak_enjin" value="baik"> Baik
                    <input type="radio" name="pemulangan_minyak_enjin" value="rosak"> Rosak
                </td>
                <td>
                    <textarea name="ulasan_minyak_enjin" rows="4"></textarea>
                </td>
            </tr>
		   
		   <tr>
                <td>6</td>
                <td>Air Bateri</td>
                <td>
                    <input type="radio" name="penyerahan_minyak_enjin" value="baik"> Baik
                    <input type="radio" name="penyerahan_minyak_enjin" value="rosak"> Rosak
                </td>
                <td>
                    <input type="radio" name="pemulangan_minyak_enjin" value="baik"> Baik
                    <input type="radio" name="pemulangan_minyak_enjin" value="rosak"> Rosak
                </td>
                <td>
                    <textarea name="ulasan_minyak_enjin" rows="4"></textarea>
                </td>
            </tr>
		   
		   <tr>
                <td>7</td>
                <td>Bolt atau Nat Tayar</td>
                <td>
                    <input type="radio" name="penyerahan_minyak_enjin" value="baik"> Baik
                    <input type="radio" name="penyerahan_minyak_enjin" value="rosak"> Rosak
                </td>
                <td>
                    <input type="radio" name="pemulangan_minyak_enjin" value="baik"> Baik
                    <input type="radio" name="pemulangan_minyak_enjin" value="rosak"> Rosak
                </td>
                <td>
                    <textarea name="ulasan_minyak_enjin" rows="4"></textarea>
                </td>
            </tr>
		   
		   <tr>
                <td>8</td>
                <td>Brek Tangan</td>
                <td>
                    <input type="radio" name="penyerahan_minyak_enjin" value="baik"> Baik
                    <input type="radio" name="penyerahan_minyak_enjin" value="rosak"> Rosak
                </td>
                <td>
                    <input type="radio" name="pemulangan_minyak_enjin" value="baik"> Baik
                    <input type="radio" name="pemulangan_minyak_enjin" value="rosak"> Rosak
                </td>
                <td>
                    <textarea name="ulasan_minyak_enjin" rows="4"></textarea>
                </td>
            </tr>
		   
		   <tr>
                <td>9</td>
                <td>Lampu Signal</td>
                <td>
                    <input type="radio" name="penyerahan_minyak_enjin" value="baik"> Baik
                    <input type="radio" name="penyerahan_minyak_enjin" value="rosak"> Rosak
                </td>
                <td>
                    <input type="radio" name="pemulangan_minyak_enjin" value="baik"> Baik
                    <input type="radio" name="pemulangan_minyak_enjin" value="rosak"> Rosak
                </td>
                <td>
                    <textarea name="ulasan_minyak_enjin" rows="4"></textarea>
                </td>
            </tr>
		   
		   <tr>
                <td>10</td>
                <td>Lampu Brek</td>
                <td>
                    <input type="radio" name="penyerahan_minyak_enjin" value="baik"> Baik
                    <input type="radio" name="penyerahan_minyak_enjin" value="rosak"> Rosak
                </td>
                <td>
                    <input type="radio" name="pemulangan_minyak_enjin" value="baik"> Baik
                    <input type="radio" name="pemulangan_minyak_enjin" value="rosak"> Rosak
                </td>
                <td>
                    <textarea name="ulasan_minyak_enjin" rows="4"></textarea>
                </td>
            </tr>
		   
		   <tr>
                <td>11</td>
                <td>Tali Sawat (Alternator, Pam Air dan Steering)</td>
                <td>
                    <input type="radio" name="penyerahan_minyak_enjin" value="baik"> Baik
                    <input type="radio" name="penyerahan_minyak_enjin" value="rosak"> Rosak
                </td>
                <td>
                    <input type="radio" name="pemulangan_minyak_enjin" value="baik"> Baik
                    <input type="radio" name="pemulangan_minyak_enjin" value="rosak"> Rosak
                </td>
                <td>
                    <textarea name="ulasan_minyak_enjin" rows="4"></textarea>
                </td>
            </tr>
		   
		   <tr>
                <td>12</td>
                <td>Bahan Api</td>
                <td>
                    <input type="radio" name="penyerahan_minyak_enjin" value="baik"> Baik
                    <input type="radio" name="penyerahan_minyak_enjin" value="rosak"> Rosak
                </td>
                <td>
                    <input type="radio" name="pemulangan_minyak_enjin" value="baik"> Baik
                    <input type="radio" name="pemulangan_minyak_enjin" value="rosak"> Rosak
                </td>
                <td>
                    <textarea name="ulasan_minyak_enjin" rows="4"></textarea>
                </td>
            </tr>
		   
		   <tr>
                <td>13</td>
                <td>Minyak Gris</td>
                <td>
                    <input type="radio" name="penyerahan_minyak_enjin" value="baik"> Baik
                    <input type="radio" name="penyerahan_minyak_enjin" value="rosak"> Rosak
                </td>
                <td>
                    <input type="radio" name="pemulangan_minyak_enjin" value="baik"> Baik
                    <input type="radio" name="pemulangan_minyak_enjin" value="rosak"> Rosak
                </td>
                <td>
                    <textarea name="ulasan_minyak_enjin" rows="4"></textarea>
                </td>
            </tr>
		   
		   <tr>
                <td>14</td>
                <td>Kebersihan</td>
                <td>
                    <input type="radio" name="penyerahan_minyak_enjin" value="baik"> Baik
                    <input type="radio" name="penyerahan_minyak_enjin" value="rosak"> Rosak
                </td>
                <td>
                    <input type="radio" name="pemulangan_minyak_enjin" value="baik"> Baik
                    <input type="radio" name="pemulangan_minyak_enjin" value="rosak"> Rosak
                </td>
                <td>
                    <textarea name="ulasan_minyak_enjin" rows="4"></textarea>
                </td>
            </tr>
		   
        </table>

        <input type="submit" value="Hantar">
    </form>
</div>

</body>
</html>

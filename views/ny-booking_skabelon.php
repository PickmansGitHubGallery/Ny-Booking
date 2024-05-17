
<style>
        #ny-booking-form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        #ny-booking-form .form-table {
            width: 100%;
            border-collapse: collapse;
        }
        #ny-booking-form th {
            text-align: left;
            padding: 10px 0;
        }
        #ny-booking-form td {
            padding: 10px 0;
        }
        #ny-booking-form input[type="text"],
        #ny-booking-form input[type="number"],
        #ny-booking-form input[type="date"],
        #ny-booking-form input[type="time"],
        #ny-booking-form select {
            width: calc(100% - 10px);
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        #ny-booking-form .button-primary {
            background-color: #0073aa;
            border-color: #006799;
            color: #fff;
            text-decoration: none;
            text-shadow: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, border-color 0.3s;
        }
        #ny-booking-form .button-primary:hover {
            background-color: #005a8e;
            border-color: #004e7a;
        }
        #ny-booking-form label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        #ny-booking-form input:focus,
        #ny-booking-form select:focus {
            border-color: #0073aa;
            box-shadow: 0 0 5px rgba(0, 115, 170, 0.5);
            outline: none;
        }
    </style>
<form id="ny-booking-form" method="post" action="">
    <table class="form-table ny_booking-metabox"> 
        <tr>
            <th>
                <label for="ny_booking_navn">Navn</label>
            </th>
            <td>
                <input 
                    type="text" 
                    name="ny_booking_navn" 
                    id="ny_booking_navn" 
                    class="regular-text navn-text"
                    value=""
                    required
                >
            </td>
        </tr>
        <tr>
            <th>
                <label for="ny_booking_telefon">Telefon nummer</label>
            </th>
            <td>
                <input 
                    type="number" 
                    name="ny_booking_telefon" 
                    id="ny_booking_telefon" 
                    class="regular-text telefon-text"
                    value=""
                    required
                >
            </td>
        </tr>
        <tr>
            <th>
                <label for="ny_booking_behandling">Behandling</label>
            </th>
            <td>
                <select 
                    name="ny_booking_behandling" 
                    id="ny_booking_behandling" 
                    class="regular-text behandling-select"
                    required
                >
                    <option value="klip_voksen">Voksen Klip</option>
                    <option value="boerne_klip">Børne Klip</option>
                    <option value="farvning">Farvning</option>
                    <option value="barbering">Skægtrimning og barbering</option>
                </select>
            </td>
        </tr>
        <tr>
            <th>
                <label for="ny_booking_dato">Dato</label>
            </th>
            <td>
                <input 
                    type="date" 
                    name="ny_booking_dato" 
                    id="ny_booking_dato" 
                    class="regular-text dato-text"
                    value=""
                    required
                >
            </td>
        </tr>
        <tr>
    <th>
        <label for="ny_booking_tid">Tid</label>
    </th>
    <td>
        <select
            name="ny_booking_tid"
            id="ny_booking_tid"
            class="regular-text tid-select"
            required
        >
            <option value="08:00-09:00">08:00-09:00</option>
            <option value="09:00-10:00">09:00-10:00</option>
            <option value="10:00-11:00">10:00-11:00</option>
            <option value="11:00-12:00">11:00-12:00</option>
            <option value="12:00-13:00">12:00-13:00</option>
            <option value="13:00-14:00">13:00-14:00</option>
            <option value="14:00-15:00">14:00-15:00</option>
            <option value="15:00-16:00">15:00-16:00</option>
            <option value="16:00-17:00">16:00-17:00</option>
        </select>
    </td>
</tr>
    </table>
    <p>
        <input type="submit" value="Book" class="button button-primary">
    </p>
</form>

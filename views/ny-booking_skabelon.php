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
                    <option value="klip">Klip</option>
                    <option value="farvning">Farvning</option>
                    <option value="boerne_klip">Børne Klip</option>
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
                <input 
                    type="time" 
                    name="ny_booking_tid" 
                    id="ny_booking_tid" 
                    class="regular-text tid-text"
                    value=""
                    required
                >
            </td>
        </tr>
    </table>
    <p>
        <input type="submit" value="Book" class="button button-primary">
    </p>
</form>

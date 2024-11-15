{{ header }}

<table width="100%">
    <tbody>
        <tr>
            <td class="wrapper" width="700" align="center">
                <table class="section" cellpadding="0" cellspacing="0" width="700" bgcolor="#f8f8f8">
                    <tr>
                        <td class="column" align="left">
                            <table>
                                <tbody>
                                <tr>
                                    <td align="left" style="padding: 20px 50px;">
                                        <p>
                                            <strong>Hello, Thanks for booking rooms from {{ site_title }}:</strong>
                                        </p>
                                        <p>
                                            We hope this message finds you well. We wanted to inform you that there has been a recent update regarding your booking with us. Your booking status has undergone a change, and we wanted to keep you in the loop.
                                        </p>
                                        <p>
                                            <strong>Booking Details:</strong>
                                            <ul>
                                                <li><strong>Name:</strong> {{ booking_name }}</li>
                                                <li><strong>Date of Booking:</strong> {{ booking_date }}</li>
                                                <li><strong>View booking detail:</strong> {{ booking_link }}</li>
                                            </ul>
                                        </p>
                                        <p>
                                            <strong>New Booking Status:</strong> {{ booking_status }}
                                        </p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>

{{ footer }}

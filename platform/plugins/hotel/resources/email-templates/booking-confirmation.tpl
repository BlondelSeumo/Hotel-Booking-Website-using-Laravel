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
                                        <p><strong>Hello, Thanks for booking rooms from {{ site_title }}:</strong></p>
                                        <p><img src="{{ site_url }}/vendor/core/core/base/images/emails/person.png"
                                                alt="From" width="20" style="margin-right: 10px;" /> {{ booking_name }}</p>
                                        <p><img src="{{ site_url }}/vendor/core/core/base/images/emails/email.png"
                                                alt="Email" width="20" style="margin-right: 10px;" /> {{ booking_email }}</p>
                                        <p><img src="{{ site_url }}/vendor/core/core/base/images/emails/phone.png"
                                                alt="Phone" width="20" style="margin-right: 10px;" /> {{ booking_phone }}</p>
                                        {% if booking_address %}
                                            <p><img src="{{ site_url }}/vendor/core/core/base/images/emails/map.png"
                                                    alt="Message" width="20" style="margin-right: 10px;" /> {{ booking_address }}</p>
                                        {% endif %}
                                        {% if booking_request %}
                                            <p><img src="{{ site_url }}/vendor/core/core/base/images/emails/message.png"
                                                    alt="Message" width="20" style="margin-right: 10px;" /> {{ booking_request }}</p>
                                        {% endif %}
                                        <p>View booking detail: {{ booking_link }}</p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
{{ footer }}

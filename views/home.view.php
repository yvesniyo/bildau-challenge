<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spams Reports</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.14/dist/vue.js"></script>

    <link rel="stylesheet" href="/assets/main.css">
</head>

<body>
    <div id="app">

        <div class="container">

            <h3>Reports</h3>
            <div class="item shadow-xl" v-for="report in reports" :key="report.id">
                <div>
                    <p>Id: {{report.id}}</p>
                    <p>State: {{report.state}}</p>
                    <p><a href="#">Details</a></p>
                </div>
                <div class="messages-and-options">
                    <div>
                        <p>Type: {{report.type}}</p>
                        <p>Message: <span> {{report.message}}</span></p>

                    </div>

                    <div>
                        <button class="btn" @click="block(report.id)"> Block</button>
                        <button class="btn" @click="resolve(report.id)"> Resolve</button>
                    </div>

                </div>


            </div>
        </div>
    </div>

</body>

<script>
    new Vue({
        el: '#app',
        data: {
            reports: []
        },
        mounted() {

            this.fetchAllSpams();
        },
        methods: {
            async fetchAllSpams() {

                try {
                    const data = await fetch("/reports").then((i) => i.json());

                    this.reports = data;
                } catch (error) {
                    console.error(error)
                }
            },
            async resolve(id) {

                try {

                    const url = "/reports/" + id;

                    const data = await fetch(url, {
                        method: "PUT",
                        body: JSON.stringify({
                            ticketState: "CLOSED"
                        })
                    }).then((res) => res.json())

                    this.fetchAllSpams();

                    alert(data.message)


                } catch (error) {

                }
            },
            async block(id) {
                try {

                    const url = "/reports/block/" + id;

                    const data = await fetch(url, {
                        method: "PUT",
                    }).then((res) => res.json())

                    this.fetchAllSpams();

                    alert(data.message)

                } catch (error) {

                    alert(error.message)
                }

            },
        }

    });
</script>

</html>
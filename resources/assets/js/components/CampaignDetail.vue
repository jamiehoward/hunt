<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">{{campaign.title}}</h4>
                    <h5 class="card-subtitle text-gray">Introduction:</h5>
                    <p class="card-text">{{campaign.introduction}}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
        </div>
    </div>

</template>

<script>
    export default {
        props : ['id'],
        data : function() {
            return {
                campaign : {},
            }
        },
        methods: {
            getCampaign: function() {
                axios.get('/api/campaigns/' + this.id).then(response => this.campaign = response.data);    
            },
        },
        mounted() {
            this.getCampaign();
        }
    }
</script>

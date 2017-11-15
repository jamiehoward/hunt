<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Clue campaigns</div>
                    <div class="panel-body">

                        <form id="create-campaign-form"  v-on:submit.prevent="saveCampaign">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder='Title' v-model="title" required />
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" placeholder='Introduction text' v-model="intro"></textarea>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-block btn-primary" value="Add Campaign">
                            </div>

                        </form>

                        <hr />

                        <ul class="list-group">
                            <li v-for="campaign in campaigns" :key="campaign.id" v-on:campaignSaved="getCampaigns" class="list-group-item">
                                <div>
                                        <h3>{{campaign.title}}</h3>
                                        <p>{{campaign.introduction}}</p>
                                </div>
                            </li>
                        </ul>

                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['campaigns', 'title', 'intro'],
        methods: {
            saveCampaign : function () {                
                const self = this;

                axios.post('/api/campaigns', { title: this.title, introduction: this.intro })
                  .then(function(response){
                    self.campaigns.unshift(response.data);
                    self.title = self.intro = '';
                  });
            },
            getCampaigns: function() {
                axios.get('/api/campaigns').then(response => this.campaigns = response.data);    
            }
        },
        mounted() {
            this.getCampaigns();
        }
    }
</script>

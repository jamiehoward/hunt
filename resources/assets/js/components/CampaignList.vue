<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add a new clue campaign</h4>
                        <form id="create-campaign-form"  v-on:submit.prevent="saveCampaign">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder='Title' v-model="title" required />
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" placeholder='Introduction text' v-model="intro"></textarea>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-block btn-primary" value="Save Campaign">
                            </div>

                        </form>

                        <hr />

                        <div class="text-center">
                            <h3 class="text-muted" v-if="campaigns.length == 0">No campaigns yet. Add one!</h3>
                        </div>

                        <div class="row">
                            <div class="col">
                                <h4 class="card-title">My campaigns</h4>
                                <div class="card-columns">
                                    <div class="card" v-for="campaign in campaigns" :key="campaign.id" v-on:campaignSaved="getCampaigns" >
                                      <div class="card-body">
                                        <h3 class="card-title">{{campaign.title}}</h3>
                                        <p class="card-text">{{campaign.introduction}}</p>
                                        <a v-bind:href="getCampaignLink(campaign.id)" class="card-link">Edit</a>
                                        <a href="#" class="card-link text-danger" v-on:click="deleteCampaign(campaign.id)">Delete</a>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        data : function() {
            return {
                campaigns :[], 
                title: '', 
                intro: ''
            }
        },
        methods: {
            saveCampaign : function () {                
                const self = this;

                axios.post('/api/campaigns', { title: this.title, introduction: this.intro })
                  .then(function(response){
                    self.campaigns.unshift(response.data);
                    self.title = self.intro = '';

                    swal("Campaign successfully created!", {
                      icon: 'success',
                      button: false,
                      timer: 1500
                    });

                  });
            },
            getCampaignLink : function(id) {
                return '/campaigns/' + id;
            },
            getCampaigns: function() {
                axios.get('/api/campaigns').then(response => this.campaigns = response.data);    
            },
            deleteCampaign : function(id) {
                const self = this;

                swal("Are you sure that you want to delete this campaign?", {
                  buttons: {
                    cancel: "Cancel",
                    delete: true,
                  },
                })
                .then((value) => {
                  switch (value) {
                 
                    case "cancel":
                      swal.close();
                      break;
                 
                    case "delete":
                      axios.delete('/api/campaigns/' + id)
                          .then(function(response){
                            self.campaigns = response.data;

                            swal("Campaign successfully deleted!", {
                              icon: 'success',
                              button: false,
                              timer: 1500
                            });

                          });
                  }
                });
            }
        },
        mounted() {
            this.getCampaigns();
        }
    }
</script>

<template>
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <div id="campaign-header">
                    <h1 class="display-3 text-primary" v-on:click="showEditForm">
                        {{campaign.title}}
                    </h1>
                    <p class="lead">
                        {{campaign.introduction}}
                    </p>
                </div>

                <div id="campaign-edit-form" class="text-left">
                    <h1 class="display-3">Edit campaign</h1>
                    <form v-on:submit.prevent="saveCampaign">
                        <div class="form-group">
                            <label class="form-label">Campaign title</label>
                            <input type="text" v-model='campaign.title' class="form-control form-control-lg" id="campaign-title" />
                        </div>

                        <div class="form-group">
                            <label class="form-label">Introduction text</label>
                            <textarea type="text" v-model='campaign.introduction' class="form-control form-control-lg"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Resolution text</label>
                            <textarea type="text" v-model='campaign.resolution_text' class="form-control form-control-lg"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Resolution link</label>
                            <input type="text" class="form-control
                             form-control-lg" v-model='campaign.resolution_link' />
                        </div>

                        <div class="form-group">
                            <a href="#" class="btn btn-default" v-on:click="hideEditForm">Cancel</a>
                            <input type="submit" class="btn btn-primary" value="Save changes" /> 
                        </div>
                    </form>

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
            saveCampaign : function () {                
                const self = this;

                axios.put('/api/campaigns/' + this.campaign.id, 
                    { 
                        title: this.campaign.title, 
                        introduction: this.campaign.introduction,
                        resolution_text: this.campaign.resolution_text,
                        resolution_link: this.campaign.resolution_link,
                    })
                  .then(function(response){

                    swal("Campaign successfully update!", {
                      icon: 'success',
                      button: false,
                      timer: 1500
                    });

                    self.getCampaign();
                    self.hideEditForm();
                  });
            },
            showEditForm: function() {
                $("#campaign-edit-form").show();
                $("#campaign-header").hide();
                $("#campaign-title").focus();
            },
            hideEditForm: function() {
                $("#campaign-edit-form").hide();
                $("#campaign-header").show();
            }
        },
        mounted() {
            $("#campaign-edit-form").hide();
            this.getCampaign();
        }
    }
</script>

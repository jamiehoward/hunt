<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <h4 class="card-title">Add a new clue</h4>
                <form id="create-campaign-form"  v-on:submit.prevent="saveClue">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder='Label' v-model="label" required />
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder='Answer' v-model="answer" required />
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-block btn-primary" value="Save Clue">
                    </div>

                </form>
            </div>
        </div>
        
        <div class="row">
        </div>
    </div>

</template>

<script>
    export default {
        props : ['campaign'],
        data : function() {
            return {
                label: '', 
                answer: ''
            }
        },
        methods: {
            saveClue : function () {                
                const self = this;

                axios.post('/api/campaigns/' + this.campaign + '/clues', { label: this.label, answer: this.answer })
                  .then(function(response){
                    getClues();
                    self.label = self.answer = '';

                    swal("Clue successfully created!", {
                      icon: 'success',
                      button: false,
                      timer: 1500
                    });

                  });
            }
        }
    }
</script>

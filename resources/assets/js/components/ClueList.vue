<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <h4 class="card-title">Add a new clue</h4>
                <form id="create-campaign-form"  v-on:submit.prevent="saveClue">
                    <div class="form-group">
                        <input type="text" class="form-control" id="clue-label" placeholder='Label' v-model="label" required />
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="clue-answer" placeholder='Answer' v-model="answer" required />
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-block btn-primary" id="clue-submit" value="Save Clue">
                    </div>

                </form>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <h4 class="card-title">Clues</h4>
                <div class="list-group">
                  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start" v-for="clue in clues">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1">{{clue.label}}</h5>
                      <button type="button" class="close" aria-label="Close" v-on:click="deleteClue(clue.id)">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <p class="mb-1">{{clue.answer}}</p>
                    <!-- <small>Donec id elit non mi porta.</small> -->
                  </a>
                </div>

                <div class="text-center">
                    <h3 class="text-muted" v-if="clues.length == 0">No clues yet. Add one!</h3>
                </div>
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
                clues : [],
                label: '', 
                answer: ''
            }
        },
        methods: {
            saveClue : function () {
                const self = this;

                axios.post('/api/campaigns/' + this.campaign + '/clues', { label: this.label, answer: this.answer })
                  .then(function(response){
                    self.getClues();
                    
                    self.label = self.answer = '';

                    swal("Clue successfully created!", {
                      icon: 'success',
                      button: false,
                      timer: 1500
                    });

                  });
            },
            deleteClue: function(id) {
                const self = this;

                swal("Are you sure that you want to delete this clue?", {
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
                      axios.delete('/api/clues/' + id)
                          .then(function(response){
                            self.getClues();

                            swal("Campaign successfully deleted!", {
                              icon: 'success',
                              button: false,
                              timer: 1500
                            });

                          });
                  }
                });
            },
            getClues: function() {
                axios.get('/api/campaigns/' + this.campaign + '/clues').then(response => this.clues = response.data);    
            },
        },
        mounted() {
            this.getClues();
        }
    }
</script>

<template>
    <div class="container">
        <div class="row align-items-start">
            <div class="col-lg-4 offset-lg-4 text-center">
                <div class="progress" style="height:2px;">
                  <div class="progress-bar bg-warning" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>

        <div class="row align-items-center">
            <div class="col">
                <div class="row text-center">
                    <div class="col text-center">
                        <h1 class="display-2">{{ clue.label }}</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 offset-lg-4 text-center">
                        <form v-on:submit.prevent="submitAnswer">
                            <div class="input-group">
                              <input type="text" class="form-control" placeholder="Answer" aria-label="Answer" v-model="answer" required>
                              <span class="input-group-btn">
                                <button class="btn btn-warning" type="button">Guess!</button>
                              </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row align-items-end">
            <div class="col">
                &nbsp;    
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props : ['id'],
        data : function() {
            return {
                answer: '',
                clue : {}
            }
        },
        methods: {
            getClue : function () {
                const self = this;

                axios.get('/api/clues/' + this.id)
                    .then(function(response) {
                        self.clue = response.data;
                    });
            },
            submitAnswer : function () {                
                const self = this;

                axios.post('/api/clues/' + this.clue.id + '/answers', { content: this.answer })
                  .then(function(response){
                    
                    self.answer = '';

                    if (response.data.correct) {
                        swal("Your answer was correct!", {
                          icon: 'success',
                          button: false,
                          timer: 3000
                        }).then(function() {
                            window.location.reload();
                        });
                    } else {
                        swal("Your answer was incorrect!", {
                          icon: 'error',
                          button: false,
                          timer: 1500
                        });
                    }
                  });
            }
        },
        mounted() {
            this.getClue();
        }
    }
</script>

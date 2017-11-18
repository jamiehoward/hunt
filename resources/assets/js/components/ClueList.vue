<template>
    <div class="container">
        <div class="row col">
            <h2>Clues</h2>
        </div>
        <div class="row">
            <div class="col">
                <div class="list-group">
                  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start" v-for="clue in clues">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1">{{clue.label}}</h5>
                      <!-- <small>3 days ago</small> -->
                    </div>
                    <p class="mb-1">{{clue.answer}}</p>
                    <!-- <small>Donec id elit non mi porta.</small> -->
                  </a>
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
            }
        },
        methods: {
            getClues: function() {
                axios.get('/api/campaigns/' + this.campaign + '/clues').then(response => this.clues = response.data);    
            },
        },
        mounted() {
            this.getClues();
        }
    }
</script>

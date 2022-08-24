<template>
    <div class="container">
        <div class="row mt-5">
            <div class="offset-3 col-6">
                <form class="row p-5 border rounded">

                    <div class="mb-3 col-12 col-md-6">
                        <label for="exampleFormControlSelect1">Première devise</label>
                            <select class="form-control">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="exampleFormControlSelect1">Seconde devise</label>
                            <select class="form-control">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>

                    <div class="mb-3 col-12 col-md-5">
                        <label>Taux de conversion 1</label>
                        <input disabled class="form-control" placeholder="Taux de conversion" value="1">
                    </div>
                    <div class="mb-3 col-12 col-md-2 text-center">
                        <span class="fs-1">-></span>
                    </div>
                    <div class="mb-3 col-12 col-md-5">
                        <label>Taux de conversion 2</label>
                        <input type="number" step=".01" min="0" class="form-control" placeholder="Taux de conversion">
                    </div>

                    <div class="mb-3 col-12 col-md-5">
                        <label>Taux de conversion 2</label>
                        <input disabled class="form-control" placeholder="Taux de conversion" value="1">
                    </div>
                    <div class="mb-3 col-12 col-md-2 text-center">
                        <span class="fs-1">-></span>
                    </div>
                    <div class="mb-3 col-12 col-md-5">
                        <label>Taux de conversion 1</label>
                        <input disabled type="number" step=".01" min="0" class="form-control" placeholder="Taux de conversion">
                    </div>
                   
                    <button type="submit" class="btn btn-primary w-auto mx-auto">Créer</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
        name: 'AddCurrencyPair'
}
</script>
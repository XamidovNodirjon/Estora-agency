<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <header class="header fixed top-0 w-full z-50">
      <div class="container flex justify-between items-center">
        <div class="logo">
          <img src="/images/logo.png" alt="Estora" class="h-10">
          <span>Estora</span>
        </div>
        <a href="tel:+998951606446" class="phone-btn">
          <i class="bi bi-telephone-fill"></i> +998 (95) 160 64 46
        </a>
      </div>
    </header>

    <!-- Hero Section -->
    <section class="search-hero mt-20">
      <div class="container text-center text-white">
        <h1 class="text-4xl md:text-5xl font-bold">Jami natijalar: {{ totalResults }}</h1>
        <p class="mt-2 text-lg">Qayerda yashashni emas, qanday yashashni birga tanlaymiz.</p>
      </div>
    </section>

    <!-- Filter Card -->
    <div class="container -mt-16 relative z-10">
      <div class="search-form-card">
        <h2 class="text-xl font-bold text-center mb-6">Qidiruv filtrlari</h2>
        <form @submit.prevent="applyFilters">
          <div class="form-grid">
            <div class="form-group">
              <label>E'lon turi</label>
              <select v-model="filters.ad_type" class="form-control">
                <option value="All">Hammasi</option>
                <option value="sale">Sotish</option>
                <option value="rent">Ijaraga</option>
              </select>
            </div>

            <div class="form-group">
              <label>Mulk turi</label>
              <select v-model="filters.property_type" class="form-control">
                <option value="All">Hammasi</option>
                <option value="apartment">Kvartira</option>
                <option value="house">Uy/Hovli</option>
                <option value="land">Yer</option>
                <option value="commercial">Tijorat</option>
              </select>
            </div>

            <div class="form-group">
              <label>Xonalar</label>
              <select v-model="filters.rooms" class="form-control">
                <option value="All">Hammasi</option>
                <option v-for="n in 5" :key="n" :value="n">{{ n }} xona</option>
                <option value="5+">5+</option>
              </select>
            </div>

            <div class="form-group">
              <label>Narxdan</label>
              <input type="number" v-model="filters.price_from" placeholder="0" class="form-control">
            </div>

            <div class="form-group">
              <label>Nargacha</label>
              <input type="number" v-model="filters.price_to" placeholder="∞" class="form-control">
            </div>

            <div class="form-group">
              <label>Hudud</label>
              <select v-model="filters.region" @change="loadCities" class="form-control">
                <option value="All">Hammasi</option>
                <option v-for="region in regions" :key="region.id" :value="region.id">
                  {{ region.name }}
                </option>
              </select>
            </div>

            <div class="form-group">
              <label>Shahar</label>
              <select v-model="filters.city" :disabled="loadingCities" class="form-control">
                <option value="All">Hammasi</option>
                <option v-for="city in cities" :key="city.id" :value="city.id">
                  {{ city.name }}
                </option>
              </select>
            </div>
          </div>

          <div class="filter-actions">
            <button type="button" class="btn btn-outline">
              <i class="bi bi-funnel"></i> Yana filterlar
            </button>
            <div class="flex gap-3">
              <button type="button" class="btn btn-outline">
                <i class="bi bi-geo-alt"></i> Xarita
              </button>
              <button type="submit" class="btn btn-secondary">
                <i class="bi bi-search"></i> Qidirish
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Ads Listing -->
    <section class="container py-12">
      <h2 class="text-3xl font-bold text-center mb-8">Topilgan e'lonlar</h2>

      <div v-if="loading" class="text-center py-10">
        <div class="spinner"></div>
      </div>

      <div v-else-if="filteredProducts.length === 0" class="text-center text-gray-500 py-10">
        Hech narsa topilmadi. Boshqa sozlamalarni sinab ko'ring.
      </div>

      <div v-else class="ads-grid">
        <article
          v-for="product in filteredProducts"
          :key="product.id"
          class="ad-card"
          @click="goToProduct(product.id)"
        >
          <!-- Image Gallery -->
          <div class="image-gallery">
            <img
              v-for="(img, i) in product.images"
              :key="i"
              :src="img"
              class="ad-image"
              :class="{ 'opacity-100': currentImage[product.id] === i }"
              v-show="currentImage[product.id] === i"
            />
            <img
              v-if="!product.images || product.images.length === 0"
              src="https://placehold.co/400x300?text=No+Image"
              class="ad-image"
            />

            <button
              v-if="product.images.length > 1"
              @click.stop="prevImage(product.id, product.images.length)"
              class="nav-btn prev-btn"
            >‹</button>
            <button
              v-if="product.images.length > 1"
              @click.stop="nextImage(product.id, product.images.length)"
              class="nav-btn next-btn"
            >›</button>
          </div>

          <div class="ad-info">
            <div class="ad-price">{{ formatPrice(product.price) }} USD</div>
            <h3 class="ad-title">{{ product.name }}</h3>
            <p class="ad-location">
              <i class="bi bi-geo-alt-fill"></i>
              {{ product.region?.name }}, {{ product.city?.name }}
            </p>

            <div class="ad-details">
              <span v-if="product.rooms" class="detail-item">
                <i class="bi bi-door-open"></i> {{ product.rooms }} xona
              </span>
              <span v-if="product.square" class="detail-item">
                <i class="bi bi-rulers"></i> {{ product.square }} m²
              </span>
              <span v-if="product.floor" class="detail-item">
                <i class="bi bi-building"></i> {{ product.floor }}/{{ product.building_floor }}
              </span>
            </div>

            <div class="ad-actions">
              <button @click.stop="goToProduct(product.id)" class="btn btn-view">
                Batafsil
              </button>
              <button @click.stop="openContactModal(product)" class="btn btn-contact">
                Aloqa
              </button>
            </div>
          </div>
        </article>
      </div>

      <!-- Pagination -->
      <div class="mt-10 flex justify-center" v-if="totalPages > 1">
        <nav class="flex space-x-2">
          <button
            v-for="page in totalPages"
            :key="page"
            @click="goToPage(page)"
            :class="['px-4 py-2 rounded', currentPage === page ? 'bg-orange-500 text-white' : 'bg-white border']"
          >
            {{ page }}
          </button>
        </nav>
      </div>
    </section>

    <!-- Contact Modal -->
    <teleport to="body">
      <div v-if="showContactModal" class="modal" @click="closeModal">
        <div class="modal-content" @click.stop>
          <span class="close-btn" @click="closeModal">×</span>
          <h3 class="text-xl font-bold text-center mb-4">Bog'lanish</h3>
          <p class="text-center mb-6">E'lon: <strong>{{ selectedProduct?.name }}</strong></p>
          <form @submit.prevent="submitContact">
            <input type="text" placeholder="Ismingiz" class="form-control mb-4" required />
            <input type="tel" placeholder="Telefon" class="form-control mb-4" required />
            <button type="submit" class="btn btn-secondary w-full">Yuborish</button>
          </form>
        </div>
      </div>
    </teleport>
  </div>
</template>

<script setup>
import { ref, reactive, onMounted, watch } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import axios from 'axios'

const route = useRoute()
const router = useRouter()

// Props from Laravel (Inertia or @props)
defineProps({
  regions: Array,
  initialCities: Array,
  bestOffers: Array,
  statistics: Object,
  initialProducts: Array,
  totalResults: Number,
})

// Reactive state
const filters = reactive({
  ad_type: 'All',
  property_type: 'All',
  rooms: 'All',
  price_from: '',
  price_to: '',
  region: 'All',
  city: 'All',
})

const cities = ref([])
const loadingCities = ref(false)
const filteredProducts = ref([])
const currentPage = ref(1)
const totalPages = ref(1)
const loading = ref(false)
const currentImage = ref({})
const showContactModal = ref(false)
const selectedProduct = ref(null)

// Init
onMounted(() => {
  cities.value = props.initialCities || []
  filteredProducts.value = props.initialProducts || []
  totalPages.value = Math.ceil(props.totalResults / 10) || 1

  // Restore filters from URL
  Object.keys(filters).forEach(key => {
    if (route.query[key]) filters[key] = route.query[key]
  })

  // Init image index
  filteredProducts.value.forEach(p => {
    currentImage.value[p.id] = 0
  })
})

// Load cities
const loadCities = async () => {
  if (filters.region === 'All') {
    cities.value = []
    filters.city = 'All'
    return
  }

  loadingCities.value = true
  try {
    const res = await axios.get(`/get-cities/${filters.region}`)
    cities.value = res.data
    filters.city = 'All'
  } catch (err) {
    console.error(err)
  } finally {
    loadingCities.value = false
  }
}

// Apply filters
const applyFilters = () => {
  const query = { ...filters, page: 1 }
  Object.keys(query).forEach(key => query[key] === 'All' && delete query[key])
  router.push({ path: '/dashboard', query })
}

// Pagination
const goToPage = (page) => {
  currentPage.value = page
  applyFilters()
}

// Image navigation
const prevImage = (id, len) => {
  currentImage.value[id] = (currentImage.value[id] - 1 + len) % len
}
const nextImage = (id, len) => {
  currentImage.value[id] = (currentImage.value[id] + 1) % len
}

// Product detail
const goToProduct = (id) => {
  router.push(`/product/${id}`)
}

// Contact modal
const openContactModal = (product) => {
  selectedProduct.value = product
  showContactModal.value = true
}
const closeModal = () => {
  showContactModal.value = false
}
const submitContact = () => {
  alert('So‘rov yuborildi!')
  closeModal()
}

// Format price
const formatPrice = (price) => {
  return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ')
}

// Watch URL changes (Inertia-like)
watch(() => route.query, async (newQuery) => {
  loading.value = true
  try {
    const res = await axios.get('/filter', { params: newQuery })
    filteredProducts.value = res.data.data
    totalPages.value = res.data.last_page
    currentPage.value = res.data.current_page
    totalResults.value = res.data.total

    // Reset image index
    filteredProducts.value.forEach(p => {
      currentImage.value[p.id] = 0
    })
  } catch (err) {
    console.error(err)
  } finally {
    loading.value = false
  }
}, { deep: true })
</script>

<style scoped>
/* Same CSS as in your Blade file */
.header { @apply bg-white shadow-lg; }
.phone-btn { @apply bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-6 rounded-full; }
.search-hero { @apply bg-cover bg-center h-96 flex items-center justify-center; background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('/images/dashboard.png'); }
.search-form-card { @apply bg-white rounded-xl shadow-xl p-8 -mt-20; }
.form-control { @apply w-full p-3 border rounded-lg focus:border-blue-500 focus:ring focus:ring-blue-200; }
.btn { @apply px-4 py-2 rounded-lg font-semibold flex items-center gap-2 transition; }
.btn-secondary { @apply bg-orange-500 hover:bg-orange-600 text-white; }
.btn-outline { @apply border border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white; }
.ads-grid { @apply grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6; }
.ad-card { @apply bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all cursor-pointer; }
.image-gallery { @apply relative h-52 overflow-hidden; }
.ad-image { @apply absolute inset-0 w-full h-full object-cover transition-opacity; }
.nav-btn { @apply absolute top-1/2 -translate-y-1/2 bg-black bg-opacity-50 text-white w-10 h-10 rounded-full flex items-center justify-center opacity-0 transition; }
.ad-card:hover .nav-btn { @apply opacity-100; }
.prev-btn { @apply left-3; }
.next-btn { @apply right-3; }
.ad-info { @apply p-5 flex flex-col; }
.ad-price { @apply text-2xl font-bold text-green-600; }
.ad-title { @apply text-lg font-semibold text-gray-800; }
.ad-location { @apply text-sm text-gray-600 flex items-center gap-1; }
.ad-details { @apply grid grid-cols-3 gap-2 mb-4; }
.detail-item { @apply bg-gray-100 text-xs px-2 py-1 rounded text-center flex items-center justify-center gap-1; }
.ad-actions { @apply flex gap-3 mt-auto; }
.btn-view { @apply flex-1 bg-blue-600 hover:bg-blue-700 text-white; }
.btn-contact { @apply flex-1 bg-orange-500 hover:bg-orange-600 text-white; }
.modal { @apply fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center p-4 z-50; }
.modal-content { @apply bg-white rounded-xl p-8 max-w-md w-full relative; animation: slideIn 0.4s ease; }
.close-btn { @apply absolute top-4 right-4 text-3xl text-gray-400 cursor-pointer; }
@keyframes slideIn {
  from { transform: translateY(-50px); opacity: 0; }
  to { transform: translateY(0); opacity: 1; }
}
.spinner {
  border: 4px solid #f3f3f3;
  border-top: 4px solid #F7931E;
  border-radius: 50%;
  width: 40px;
  height: 40px;
  animation: spin 1s linear infinite;
  margin: 0 auto;
}
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
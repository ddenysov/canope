<template>
  <main class="home-page">
    <!-- ========= Hero (slightly smaller) ========= -->
    <section class="hero">
      <img
        class="hero-bg"
        src="https://images.unsplash.com/photo-1516307525764-5f639f4a6302?auto=format&fit=crop&w=1400&q=80"
        alt="Cyclist riding at sunset"
      />
      <div class="overlay">
        <h1 class="headline">Pedal to Freedom</h1>
        <p class="subhead">
          Track rides, join events, and connect with riders worldwide.
        </p>
        <div class="actions">
          <router-link class="cta primary" to="/register">Get Started</router-link>
          <router-link class="cta" to="/login">Log In</router-link>
        </div>
      </div>
    </section>

    <!-- ========= Rides (moved up) ========= -->
    <section class="rides">
      <header class="rides-header">
        <h2 class="section-title">Group Rides</h2>
        <div class="tabs">
          <button
            :class="{ active: view === 'upcoming' }"
            @click="view = 'upcoming'"
          >Upcoming</button>
          <button
            :class="{ active: view === 'past' }"
            @click="view = 'past'"
          >Past</button>
        </div>
      </header>

      <ul class="ride-list">
        <li
          v-for="ride in visibleRides"
          :key="ride.id"
          class="ride-item"
        >
          <h4 class="ride-name">{{ ride.name }}</h4>
          <p class="ride-meta">
            <time :datetime="ride.date">{{ formatDate(ride.date) }}</time>
            · {{ ride.distance }} km · {{ ride.location }}
          </p>
        </li>
      </ul>
    </section>

    <!-- ========= Features ========= -->
    <section class="features">
      <article v-for="feature in features" :key="feature.title" class="feature-card">
        <span class="icon" :aria-label="feature.title" v-html="feature.icon"></span>
        <h3>{{ feature.title }}</h3>
        <p>{{ feature.description }}</p>
      </article>
    </section>

    <!-- ========= Newsletter ========= -->
    <section class="newsletter">
      <h2>Stay in the Loop</h2>
      <p>Get weekly ride tips, route inspiration, and gear reviews straight to your inbox.</p>
      <form class="newsletter-form" @submit.prevent="subscribe">
        <input
          v-model="email"
          type="email"
          placeholder="you@example.com"
          required
        />
        <button class="subscribe-btn">Subscribe</button>
      </form>
    </section>
  </main>
</template>

<script setup lang="ts">
// -----------------------------
// Home page logic
// -----------------------------
import { ref, computed } from 'vue'

interface Feature {
  title: string
  description: string
  icon: string
}

/** Icons as inline SVG (simple & lightweight) */
const features = ref<Feature[]>([
  {
    title: 'GPS Tracking',
    description: 'Log every ride with precise distance and elevation data.',
    icon: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C8.134 2 5 5.134 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.866-3.134-7-7-7zm0 9.5a2.5 2.5 0 110-5 2.5 2.5 0 010 5z" fill="currentColor"/></svg>`,
  },
  {
    title: 'Event Calendar',
    description: 'Discover group rides and races near you every weekend.',
    icon: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 2v2M17 2v2M3 7h18M5 10v10h14V10H5z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>`,
  },
  {
    title: 'Gear Reviews',
    description: 'Find the best bikes, jerseys, and gadgets tested by pros.',
    icon: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 1l3 7h7l-5.5 4.5L18 22l-6-4-6 4 1.5-9.5L2 8h7L12 1z" fill="currentColor"/></svg>`,
  },
])

interface Ride {
  id: number
  name: string
  date: string
  distance: number
  location: string
}

/** Example data sets */
const upcomingRides = ref<Ride[]>([
  { id: 1, name: 'Sunrise Sprint', date: '2025-07-02', distance: 45, location: 'Kyiv' },
  { id: 2, name: 'River Loop', date: '2025-07-05', distance: 60, location: 'Dnipro' },
  { id: 3, name: 'Mountain Challenge', date: '2025-07-12', distance: 85, location: 'Bukovel' },
])

const pastRides = ref<Ride[]>([
  { id: 4, name: 'City Night Ride', date: '2025-06-15', distance: 50, location: 'Lviv' },
  { id: 5, name: 'Forest Explorer', date: '2025-06-01', distance: 70, location: 'Chernihiv' },
  { id: 6, name: 'Lake Shore Cruise', date: '2025-05-18', distance: 40, location: 'Odesa' },
])

/** Tab state */
const view = ref<'upcoming' | 'past'>('upcoming')

const visibleRides = computed(() =>
  view.value === 'upcoming' ? upcomingRides.value : pastRides.value,
)

const email = ref<string>('')

function formatDate(dateStr: string): string {
  const date = new Date(dateStr)
  return date.toLocaleDateString('en-GB', { day: '2-digit', month: 'short' })
}

function subscribe(): void {
  if (!/.+@.+\..+/.test(email.value)) return
  // Placeholder subscribe logic
  console.log('Subscribed with', email.value)
  alert('Thanks for subscribing!')
  email.value = ''
}
</script>

<style scoped>
/* ====== Layout helpers ====== */
.home-page {
  font-family: system-ui, -apple-system, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
  line-height: 1.55;
  color: #1a202c;
}

/* ====== Hero Section ====== */
.hero {
  position: relative;
  min-height: 55vh; /* smaller */
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  overflow: hidden;
}

.hero-bg {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  filter: brightness(65%);
}

.overlay {
  position: relative;
  z-index: 1;
  max-width: 650px;
  padding: 0 1rem;
}

.headline {
  font-size: clamp(2.2rem, 5vw, 3.5rem);
  color: #fff;
  margin-bottom: 0.4rem;
}

.subhead {
  font-size: 1.15rem;
  color: #e2e8f0;
  margin-bottom: 1.25rem;
}

.actions {
  display: flex;
  gap: 1rem;
  justify-content: center;
  flex-wrap: wrap;
}

.cta {
  padding: 0.7rem 1.4rem;
  border-radius: 6px;
  font-weight: 600;
  border: 2px solid #fff;
  color: #fff;
  text-decoration: none;
  transition: background 0.2s ease;
}

.cta.primary {
  background: #2b6cb0;
  border-color: #2b6cb0;
}

.cta:hover:not(.primary) {
  background: rgba(255, 255, 255, 0.15);
}

.cta.primary:hover {
  background: #1e4d82;
}

/* ====== Rides Section ====== */
.rides {
  padding: 3rem 2rem 3.5rem;
  background: #edf2f7;
}

.rides-header {
  max-width: 1100px;
  margin: 0 auto 1.5rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 1rem;
}

.section-title {
  font-size: 1.75rem;
}

.tabs {
  display: flex;
  gap: 0.5rem;
}

.tabs button {
  background: transparent;
  border: 1px solid #cbd5e0;
  padding: 0.45rem 0.9rem;
  border-radius: 5px;
  cursor: pointer;
  font-weight: 500;
  transition: background 0.2s ease;
}

.tabs button.active {
  background: #2b6cb0;
  color: #fff;
  border-color: #2b6cb0;
}

.ride-list {
  list-style: none;
  padding: 0;
  margin: 0 auto;
  max-width: 1100px;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 1rem;
}

.ride-item {
  background: #fff;
  padding: 1.25rem 1rem;
  border-radius: 8px;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
}

.ride-name {
  font-size: 1.1rem;
  margin-bottom: 0.25rem;
}

.ride-meta {
  font-size: 0.9rem;
  color: #4a5568;
}

/* ====== Features Section ====== */
.features {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 2rem;
  padding: 3.5rem 2rem 4rem;
  max-width: 1100px;
  margin: 0 auto;
}

</style>

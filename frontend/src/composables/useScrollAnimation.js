import { ref, onMounted, onUnmounted } from 'vue'

export function useScrollAnimation(options = {}) {
  const isVisible = ref(false)
  const elementRef = ref(null)

  const observer = ref(null)

  // Default options
  const defaultOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px',
    triggerOnce: true,
    immediate: false // For elements that should be visible immediately (like home section)
  }

  const config = { ...defaultOptions, ...options }

  const checkVisibility = (entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        isVisible.value = true
        // Stop observing after first intersection if triggerOnce is true
        if (config.triggerOnce && observer.value) {
          observer.value.unobserve(entry.target)
        }
      } else if (!config.triggerOnce) {
        isVisible.value = false
      }
    })
  }

  onMounted(() => {
    // If immediate is true, show animation right away
    if (config.immediate) {
      isVisible.value = true
      return
    }

    if (elementRef.value) {
      observer.value = new IntersectionObserver(checkVisibility, {
        threshold: config.threshold,
        rootMargin: config.rootMargin
      })
      
      observer.value.observe(elementRef.value)
    }
  })

  onUnmounted(() => {
    if (observer.value) {
      observer.value.disconnect()
    }
  })

  return {
    isVisible,
    elementRef
  }
}
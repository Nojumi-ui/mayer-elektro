import { ref, onMounted, onUnmounted } from 'vue'

export function useCountAnimation(targetValue, options = {}) {
  const currentValue = ref(0)
  const elementRef = ref(null)
  const observer = ref(null)
  const animationId = ref(null)

  // Default options
  const defaultOptions = {
    duration: 2000, // Animation duration in milliseconds
    easing: 'easeOutQuart', // Easing function
    threshold: 0.3, // When to trigger the animation
    rootMargin: '0px 0px -100px 0px'
  }

  const config = { ...defaultOptions, ...options }

  // Easing functions
  const easingFunctions = {
    linear: (t) => t,
    easeOutQuart: (t) => 1 - Math.pow(1 - t, 4),
    easeOutCubic: (t) => 1 - Math.pow(1 - t, 3),
    easeInOutCubic: (t) => t < 0.5 ? 4 * t * t * t : (t - 1) * (2 * t - 2) * (2 * t - 2) + 1
  }

  const animate = () => {
    const startTime = performance.now()
    const startValue = 0
    const endValue = targetValue
    const easingFunction = easingFunctions[config.easing] || easingFunctions.easeOutQuart

    const updateValue = (currentTime) => {
      const elapsed = currentTime - startTime
      const progress = Math.min(elapsed / config.duration, 1)
      
      const easedProgress = easingFunction(progress)
      currentValue.value = Math.round(startValue + (endValue - startValue) * easedProgress)

      if (progress < 1) {
        animationId.value = requestAnimationFrame(updateValue)
      }
    }

    animationId.value = requestAnimationFrame(updateValue)
  }

  const checkVisibility = (entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        animate()
        // Stop observing after animation starts
        if (observer.value) {
          observer.value.unobserve(entry.target)
        }
      }
    })
  }

  onMounted(() => {
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
    if (animationId.value) {
      cancelAnimationFrame(animationId.value)
    }
  })

  return {
    currentValue,
    elementRef
  }
}
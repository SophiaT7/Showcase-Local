'use client'

import { icons } from 'lucide-react'

interface LucideIconProps {
  name: string
  size?: number
  className?: string
}

export default function LucideIcon({ name, size = 24, className }: LucideIconProps) {
  const pascalName = name
    .split('-')
    .map(part => part.charAt(0).toUpperCase() + part.slice(1))
    .join('')

  const Icon = (icons as Record<string, React.ComponentType<{ size?: number; className?: string }>>)[pascalName]

  if (!Icon) {
    return <span className={className}>{name}</span>
  }

  return <Icon size={size} className={className} />
}

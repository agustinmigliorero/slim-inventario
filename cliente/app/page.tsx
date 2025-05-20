import type { Metadata } from "next"
import Link from "next/link"
import { ArrowRight } from "lucide-react"

import { Button } from "@/components/ui/button"

export const metadata: Metadata = {
  title: "AgroGestión - Sistema de Inventario y Ventas",
  description: "Sistema de gestión para agronomías argentinas",
}

export default function Home() {
  return (
    <div className="flex min-h-screen w-full flex-col">
      <main className="flex-1">
        <section className="w-full py-12 md:py-24 lg:py-32 bg-green-50 dark:bg-green-950">
          <div className="container px-4 md:px-6">
            <div className="flex flex-col items-center justify-center space-y-4 text-center">
              <div className="space-y-2">
                <h1 className="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl lg:text-6xl/none">
                  AgroGestión
                </h1>
                <p className="mx-auto max-w-[700px] text-gray-500 md:text-xl dark:text-gray-400">
                  Sistema de gestión de inventario y ventas para agronomías argentinas
                </p>
              </div>
              <div className="space-x-4">
                <Link href="/dashboard">
                  <Button className="bg-green-600 hover:bg-green-700">
                    Ingresar al Sistema
                    <ArrowRight className="ml-2 h-4 w-4" />
                  </Button>
                </Link>
              </div>
            </div>
          </div>
        </section>
      </main>
    </div>
  )
}
